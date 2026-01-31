<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SyncPermissions extends Command
{
    protected $signature = 'permissions:sync {--dry-run : Show changes without modifying files}';

    protected $description = 'Normalize Gate permissions, extract them, and regenerate permission seeders';

    protected string $outputFile = 'access_test.txt';

    protected string $permissionsSeeder = 'database/seeders/PermissionsTableSeeder_TEST.php';
    protected string $permissionRoleSeeder = 'database/seeders/PermissionRoleTableSeeder_TEST.php';

    protected array $sensitiveTables = [
        'users',
        'oauth',
        'telescope',
        'debugbar',
        'personal_access_tokens',
        'sessions',
        'password_resets',
    ];

    protected array $mandatoryPermissions = [
        'profile_password_edit',
    ];

    /**
     * Extra permissions that are not defined via Gate::denies() in controllers.
     * These are used in Blade views, middleware, or other non-standard locations.
     * Add any custom permissions here that need to be included in the seeder.
     */
    protected array $extraPermissions = [
        'access_tc_dash',
        'access_mc_dash',
        'access_ingest_gis',
        'user_management_access',
        'assets_manager_access',
        'vulnerability_access',
    ];

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');

        $this->info($dryRun ? 'Running in DRY RUN mode' : 'Running in LIVE mode');

        // Auto-prefix permissions in Frontend and API controllers for granular control
        $this->normalizePermissions('app/Http/Controllers/Frontend', 'site_', $dryRun);
        $this->normalizePermissions('app/Http/Controllers/Api/V1/Admin', 'api_', $dryRun);

        $permissions = $this->extractPermissions($dryRun);
        $permissions = $this->addMandatoryPermissions($permissions);
        $permissions = $this->addExtraPermissions($permissions);
        $permissions = $this->filterSensitivePermissions($permissions);

        sort($permissions);

        if ($dryRun) {
            $this->line('');
            $this->info('Permissions that would be generated:');
            foreach ($permissions as $permission) {
                $this->line("  - {$permission}");
            }
            return self::SUCCESS;
        }

        $this->writeAccessFile($permissions);
        $this->generatePermissionSeeder($permissions);
        $this->generatePermissionRoleSeeder();

        $this->info('Permission sync completed successfully.');

        return self::SUCCESS;
    }

    protected function normalizePermissions(string $path, string $prefix, bool $dryRun): void
    {
        if (!File::exists($path)) {
            return;
        }

        foreach (File::allFiles($path) as $file) {
            $contents = File::get($file->getPathname());

            if (!str_contains($contents, "Gate::denies('")) {
                continue;
            }

            // Only prefix permissions that don't already have this prefix
            $updated = preg_replace_callback(
                "/Gate::denies\\('([^']+)'\\)/",
                function ($matches) use ($prefix) {
                    $permission = $matches[1];
                    // Skip if already has this prefix
                    if (str_starts_with($permission, $prefix)) {
                        return $matches[0];
                    }
                    return "Gate::denies('{$prefix}{$permission}')";
                },
                $contents
            );

            if ($updated !== $contents) {
                $relativePath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $this->line(($dryRun ? '[DRY] Would prefix: ' : 'Prefixing: ') . $relativePath);
                if (!$dryRun) {
                    File::put($file->getPathname(), $updated);
                }
            }
        }
    }

    protected function extractPermissions(bool $verbose = false): array
    {
        $permissions = [];
        $byGroup = [
            'admin' => [],
            'api' => [],
            'site' => [],
            'auth' => [],
            'other' => [],
        ];

        foreach (File::allFiles(app_path('Http/Controllers')) as $file) {
            preg_match_all(
                "/Gate::denies\\('([^']+)'\\)/",
                File::get($file->getPathname()),
                $matches
            );

            if (!empty($matches[1])) {
                $relativePath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $uniquePerms = array_unique($matches[1]);
                
                // Determine group and prefix (handle both / and \ path separators)
                $group = 'other';
                $prefix = '';
                $normalizedPath = str_replace('\\', '/', $relativePath);
                if (str_contains($normalizedPath, 'Controllers/Admin/')) {
                    $group = 'admin';
                    $prefix = ''; // Admin keeps original names
                } elseif (str_contains($normalizedPath, 'Controllers/Api/')) {
                    $group = 'api';
                    $prefix = 'api_';
                } elseif (str_contains($normalizedPath, 'Controllers/Frontend/')) {
                    $group = 'site';
                    $prefix = 'site_';
                } elseif (str_contains($normalizedPath, 'Controllers/Auth/')) {
                    $group = 'auth';
                    $prefix = '';
                }
                
                $byGroup[$group][$relativePath] = [
                    'permissions' => $uniquePerms,
                    'prefix' => $prefix,
                ];
                
                foreach ($matches[1] as $permission) {
                    // Add with prefix for Api/Frontend, without for Admin
                    if ($prefix && !str_starts_with($permission, $prefix)) {
                        $permissions[] = $prefix . $permission;
                    } else {
                        $permissions[] = $permission;
                    }
                }
            }
        }

        if ($verbose) {
            foreach ($byGroup as $groupName => $controllers) {
                if (empty($controllers)) continue;
                
                $this->line('');
                $this->info("=== {$groupName} Controllers ===");
                
                foreach ($controllers as $controller => $data) {
                    $this->line("  {$controller}");
                    $prefix = $data['prefix'];
                    foreach ($data['permissions'] as $perm) {
                        if ($prefix && !str_starts_with($perm, $prefix)) {
                            $this->line("    - {$perm} <fg=yellow>→ {$prefix}{$perm}</>");
                        } else {
                            $this->line("    - {$perm}");
                        }
                    }
                }
            }
        }

        return array_values(array_unique($permissions));
    }

    protected function addMandatoryPermissions(array $permissions): array
    {
        foreach ($this->mandatoryPermissions as $mandatory) {
            if (!in_array($mandatory, $permissions, true)) {
                $this->line("Added mandatory permission: {$mandatory}");
                $permissions[] = $mandatory;
            }
        }

        return $permissions;
    }

    protected function addExtraPermissions(array $permissions): array
    {
        foreach ($this->extraPermissions as $extra) {
            if (!in_array($extra, $permissions, true)) {
                $this->line("Added extra permission: {$extra}");
                $permissions[] = $extra;
            }
        }

        return $permissions;
    }

    protected function filterSensitivePermissions(array $permissions): array
    {
        return array_values(array_filter($permissions, function ($permission) {
            foreach ($this->sensitiveTables as $table) {
                if (str_contains($permission, $table)) {
                    $this->line("Excluded sensitive permission: {$permission}");
                    return false;
                }
            }
            return true;
        }));
    }

    protected function writeAccessFile(array $permissions): void
    {
        File::put($this->outputFile, implode(PHP_EOL, $permissions));
    }

    protected function generatePermissionSeeder(array $permissions): void
    {
        File::delete($this->permissionsSeeder);

        $lines = [];
        $id = 1;

        foreach ($permissions as $permission) {
            $lines[] = "            ['id' => {$id}, 'title' => '{$permission}'],";
            $id++;
        }

        File::put($this->permissionsSeeder, <<<PHP
<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        \$permissions = [
{$this->indentLines($lines)}
        ];

        Permission::truncate();
        Permission::insert(\$permissions);
    }
}
PHP
        );
    }

    protected function generatePermissionRoleSeeder(): void
    {
        File::delete($this->permissionRoleSeeder);

        File::put($this->permissionRoleSeeder, <<<PHP
<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        \$adminPermissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync(\$adminPermissions->pluck('id'));

        \$frontendPermissions = \$adminPermissions->filter(function (\$permission) {
            return str_contains(\$permission->title, 'access')
                || str_contains(\$permission->title, 'show');
        });

        Role::findOrFail(2)->permissions()->sync(\$frontendPermissions->pluck('id'));
    }
}
PHP
        );
    }

    protected function indentLines(array $lines): string
    {
        return implode(PHP_EOL, $lines);
    }
}
