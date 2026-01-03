<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySettingRequest;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\ContentPage;
use App\Models\Setting;
use Database\Seeders\DummyClientsSeeder;
use Database\Seeders\DummyProductsSeeder;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    private function clearCaches(): void
    {
        $basePath = base_path();
        shell_exec("cd {$basePath} && php artisan config:clear 2>&1");
        shell_exec("cd {$basePath} && php artisan cache:clear 2>&1");
    }

    private function extendTimeout(int $seconds = 300): void
    {
        set_time_limit($seconds);
        ini_set('max_execution_time', $seconds);
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Setting::query()->select(sprintf('%s.*', (new Setting)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'setting_show';
                $editGate      = 'setting_edit';
                $deleteGate    = 'setting_delete';
                $crudRoutePart = 'settings';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('key', function ($row) {
                return $row->key ? $row->key : '';
            });
            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.settings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = Setting::TYPE_SELECT;
        $groups = Setting::GROUP_SELECT;

        return view('admin.settings.create', compact('types', 'groups'));
    }

    public function store(StoreSettingRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image_value') && $request->input('type') === 'image') {
            $path = $request->file('image_value')->store('settings', 'public');
            $data['value'] = $path;
        }

        Setting::create($data);

        return redirect()->route('admin.settings.index');
    }

    public function edit(Setting $setting)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = Setting::TYPE_SELECT;
        $groups = Setting::GROUP_SELECT;

        return view('admin.settings.edit', compact('setting', 'types', 'groups'));
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $data = $request->all();

        if ($request->hasFile('image_value') && $request->input('type') === 'image') {
            $path = $request->file('image_value')->store('settings', 'public');
            $data['value'] = $path;
        }

        if ($request->input('type') === 'boolean') {
            $data['value'] = $request->has('value_bool') ? '1' : '0';
        }

        $setting->update($data);

        return redirect()->route('admin.settings.index');
    }

    public function destroy(Setting $setting)
    {
        abort_if(Gate::denies('setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setting->delete();

        return back();
    }

    public function massDestroy(MassDestroySettingRequest $request)
    {
        $settings = Setting::find(request('ids'));

        foreach ($settings as $setting) {
            $setting->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function seedDummyProducts(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            $counts = DummyProductsSeeder::seedDummyProducts(15);
            $this->clearCaches();
            $message = "Created: {$counts['products']} products, {$counts['variations']} variations";
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $message]);
            }
            return redirect()->route('admin.settings.index')->with('message', $message);
        } catch (\Exception $e) {
            $error = 'Error creating dummy products: ' . $e->getMessage();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $error], 500);
            }
            return redirect()->route('admin.settings.index')->with('error', $error);
        }
    }

    public function seedDummyAccessories(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            $counts = DummyProductsSeeder::seedDummyAccessoryProducts(5);
            $this->clearCaches();
            $message = "Created: {$counts['accessories']} accessory products";
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $message]);
            }
            return redirect()->route('admin.settings.index')->with('message', $message);
        } catch (\Exception $e) {
            $error = 'Error creating dummy accessories: ' . $e->getMessage();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $error], 500);
            }
            return redirect()->route('admin.settings.index')->with('error', $error);
        }
    }

    public function seedDummyBundles(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            $counts = DummyProductsSeeder::seedDummyBundles(1);
            $this->clearCaches();
            $message = "Created: {$counts['bundles']} bundles with {$counts['bundle_items']} items, {$counts['variations']} variations";
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $message]);
            }
            return redirect()->route('admin.settings.index')->with('message', $message);
        } catch (\Exception $e) {
            $error = 'Error creating dummy bundles: ' . $e->getMessage();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $error], 500);
            }
            return redirect()->route('admin.settings.index')->with('error', $error);
        }
    }

    public function seedDummyVariations(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            $counts = DummyProductsSeeder::seedMoreVariations();
            $this->clearCaches();
            $message = "Added variations to {$counts['products_updated']} products ({$counts['variations']} total variations)";
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $message]);
            }
            return redirect()->route('admin.settings.index')->with('message', $message);
        } catch (\Exception $e) {
            $error = 'Error creating dummy variations: ' . $e->getMessage();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $error], 500);
            }
            return redirect()->route('admin.settings.index')->with('error', $error);
        }
    }

    public function removeDummyProducts(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            $counts = DummyProductsSeeder::removeDummyProducts();
            $this->clearCaches();
            $message = "Removed: {$counts['products']} products, {$counts['variations']} variations, {$counts['categories']} categories, {$counts['tags']} tags";
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $message]);
            }
            return redirect()->route('admin.settings.index')->with('message', $message);
        } catch (\Exception $e) {
            $error = 'Error removing dummy products: ' . $e->getMessage();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $error], 500);
            }
            return redirect()->route('admin.settings.index')->with('error', $error);
        }
    }

    public function seedSettings()
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            Artisan::call('iseed', ['tables' => 'settings,media', '--force' => true]);
            $this->clearCaches();
            $output = Artisan::output();
            return redirect()->route('admin.settings.index')->with('message', 'Settings seeder generated successfully! ' . $output);
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')->with('error', 'Error generating settings seeder: ' . $e->getMessage());
        }
    }

    public function seedMenus()
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            Artisan::call('iseed', ['tables' => 'menus,menu_items', '--force' => true]);
            $this->clearCaches();
            $output = Artisan::output();
            return redirect()->route('admin.settings.index')->with('message', 'Menu seeders generated successfully! ' . $output);
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')->with('error', 'Error generating menu seeders: ' . $e->getMessage());
        }
    }

    public function seedDummyClients(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            Artisan::call('db:seed', ['--class' => 'DummyClientsSeeder']);
            $this->clearCaches();
            $message = 'Dummy clients created successfully!';
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $message]);
            }
            return redirect()->route('admin.settings.index')->with('message', $message);
        } catch (\Exception $e) {
            $error = 'Error creating dummy clients: ' . $e->getMessage();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $error], 500);
            }
            return redirect()->route('admin.settings.index')->with('error', $error);
        }
    }

    public function removeDummyClients(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            $counts = DummyClientsSeeder::removeDummyClients();
            $this->clearCaches();
            $message = "Removed: {$counts['clients']} clients, {$counts['addresses']} addresses";
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $message]);
            }
            return redirect()->route('admin.settings.index')->with('message', $message);
        } catch (\Exception $e) {
            $error = 'Error removing dummy clients: ' . $e->getMessage();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $error], 500);
            }
            return redirect()->route('admin.settings.index')->with('error', $error);
        }
    }

    public function seedDummyFaqs(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            $counts = DummyProductsSeeder::seedDummyFaqs();
            $this->clearCaches();

            if ($counts['existing_fake'] > 0) {
                $message = "Dummy FAQs already exist ({$counts['existing_fake']} categories). Remove them first before adding new ones.";
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => $message], 400);
                }
                return redirect()->route('admin.settings.index')->with('error', $message);
            }

            $message = "Created: {$counts['faq_categories']} FAQ categories, {$counts['faq_questions']} FAQ questions";
            if ($counts['skipped'] > 0) {
                $message .= " (skipped {$counts['skipped']} existing categories)";
            }
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $message]);
            }
            return redirect()->route('admin.settings.index')->with('message', $message);
        } catch (\Exception $e) {
            $error = 'Error creating dummy FAQs: ' . $e->getMessage();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $error], 500);
            }
            return redirect()->route('admin.settings.index')->with('error', $error);
        }
    }

    public function removeDummyFaqs(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            $counts = DummyProductsSeeder::removeDummyFaqs();
            $this->clearCaches();
            $message = "Removed: {$counts['faq_categories']} FAQ categories, {$counts['faq_questions']} FAQ questions";
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $message]);
            }
            return redirect()->route('admin.settings.index')->with('message', $message);
        } catch (\Exception $e) {
            $error = 'Error removing dummy FAQs: ' . $e->getMessage();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $error], 500);
            }
            return redirect()->route('admin.settings.index')->with('error', $error);
        }
    }

    public function seedDummyPages(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            $counts = DummyProductsSeeder::seedDummyPages();
            $this->clearCaches();

            if ($counts['existing_fake'] > 0) {
                $message = "Dummy pages already exist ({$counts['existing_fake']} pages). Remove them first before adding new ones.";
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => $message], 400);
                }
                return redirect()->route('admin.settings.index')->with('error', $message);
            }

            $message = "Created {$counts['created']} dummy pages";
            if ($counts['skipped'] > 0) {
                $message .= " (skipped {$counts['skipped']} existing pages)";
            }
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $message]);
            }
            return redirect()->route('admin.settings.index')->with('message', $message);
        } catch (\Exception $e) {
            $error = 'Error creating dummy pages: ' . $e->getMessage();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $error], 500);
            }
            return redirect()->route('admin.settings.index')->with('error', $error);
        }
    }

    public function removeDummyPages(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            $count = DummyProductsSeeder::removeDummyPages();
            $this->clearCaches();
            $message = "Removed {$count} dummy pages";
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $message]);
            }
            return redirect()->route('admin.settings.index')->with('message', $message);
        } catch (\Exception $e) {
            $error = 'Error removing dummy pages: ' . $e->getMessage();
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $error], 500);
            }
            return redirect()->route('admin.settings.index')->with('error', $error);
        }
    }

    public function clearTelescope()
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->extendTimeout();
            $this->clearCaches();
            $output = shell_exec("cd " . base_path() . " && php artisan telescope:clear 2>&1");
            $this->clearCaches();

            session()->flash('swal_success', 'Telescope data has been cleared. ' . $output);
            return response()->json([
                'success' => true,
                'message' => 'Telescope data has been cleared. ' . $output,
            ]);
        } catch (\Exception $e) {
            session()->flash('swal_error', 'Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ]);
        }
    }

    public function squashMigrations()
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(!auth()->user()->isWclDeveloper, Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $migrationsPath = database_path('migrations');

            $existingFiles = glob($migrationsPath . '/*_squashed_*.php');
            foreach ($existingFiles as $file) {
                File::delete($file);
            }

            $this->extendTimeout();
            $this->clearCaches();
            $output = shell_exec("cd " . base_path() . " && php artisan migrate:generate --squash --no-interaction --skip-log --skip-views --skip-proc --table-filename=\"[datetime]_squashed_growers_schema.php\" 2>&1");
            $this->clearCaches();

            session()->flash('swal_success', 'Migration squashed successfully! ' . $output);
            return response()->json([
                'success' => true,
                'message' => 'Migration squashed successfully! ' . $output,
            ]);
        } catch (\Exception $e) {
            session()->flash('swal_error', 'Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ]);
        }
    }

    public function regenerateMedia(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(!auth()->user()->isWclDeveloper, Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $mode = $request->input('mode', 'all');
            $modeText = $mode === 'missing' ? 'missing' : 'all';

            if ($mode === 'missing') {
                $exitCode = Artisan::call('media-library:regenerate', ['--only-missing' => true, '--with-responsive-images' => true]);
            } else {
                $exitCode = Artisan::call('media-library:regenerate', ['--with-responsive-images' => true]);
            }
            $output = Artisan::output();

            $message = $exitCode === 0
                ? "Media regenerated ({$modeText}) successfully!"
                : 'Failed to regenerate media: ' . $output;
            
            if ($exitCode === 0) {
                session()->flash('swal_success', $message);
            } else {
                session()->flash('swal_error', $message);
            }
            
            return response()->json([
                'success' => $exitCode === 0,
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            session()->flash('swal_error', 'Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ]);
        }
    }

    public function regenerateModelMedia(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(!auth()->user()->isWclDeveloper, Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $model = $request->input('model');
            $modelMap = [
                'ContentPage' => 'App\\Models\\ContentPage',
                'Product' => 'App\\Models\\Product',
                'Client' => 'App\\Models\\Client',
                'Setting' => 'App\\Models\\Setting',
            ];

            if (!isset($modelMap[$model])) {
                return response()->json(['success' => false, 'message' => 'Invalid model specified']);
            }

            $exitCode = Artisan::call('media-library:regenerate', [
                '--model-type' => $modelMap[$model],
                '--with-responsive-images' => true
            ]);
            $output = Artisan::output();

            $message = $exitCode === 0
                ? "Media regenerated for {$model} successfully!"
                : 'Failed to regenerate media: ' . $output;
            
            if ($exitCode === 0) {
                session()->flash('swal_success', $message);
            } else {
                session()->flash('swal_error', $message);
            }
            
            return response()->json([
                'success' => $exitCode === 0,
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            session()->flash('swal_error', 'Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ]);
        }
    }

    public function saveWizardSettings(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            if ($request->filled('company_name')) {
                Setting::set('company_name', $request->input('company_name'), 'text', 'branding', 'Company Name', 'Company name displayed throughout the site');
            }

            if ($request->hasFile('header_logo')) {
                $path = $request->file('header_logo')->store('settings', 'public');
                Setting::set('company_logo', $path, 'image', 'branding', 'Company Logo', 'Main company logo for header and documents');
            }

            if ($request->hasFile('login_image')) {
                $path = $request->file('login_image')->store('settings', 'public');
                Setting::set('login_image', $path, 'image', 'login', 'Login Background Image', 'Background image for the login page');
            }

            if ($request->filled('footer_address')) {
                Setting::set('footer_address', $request->input('footer_address'), 'textarea', 'contact', 'Footer Address', 'Company address displayed in footer');
            }

            if ($request->filled('footer_email')) {
                Setting::set('footer_email', $request->input('footer_email'), 'text', 'contact', 'Footer Email', 'Contact email displayed in footer');
            }

            if ($request->filled('footer_phone')) {
                Setting::set('footer_phone', $request->input('footer_phone'), 'text', 'contact', 'Footer Phone', 'Phone number displayed in footer');
            }

            if ($request->has('footer_disclaimer')) {
                Setting::set('footer_disclaimer', $request->input('footer_disclaimer'), 'textarea', 'contact', 'Footer Disclaimer', 'Disclaimer text displayed in footer');
            }

            \Cache::forget('settings');

            return response()->json(['success' => true, 'message' => 'Settings saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error saving settings: ' . $e->getMessage()], 500);
        }
    }

    public function createWizardPage(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        try {
            $title = $request->input('title');
            $slug = Str::slug($title);

            $existing = ContentPage::where('slug', $slug)->first();
            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'A page with this name already exists',
                    'existing_id' => $existing->id
                ], 422);
            }

            $page = ContentPage::create([
                'title' => $title,
                'slug' => $slug,
                'published' => false,
                'page_type' => 'general',
                'page_text' => '<p>Content coming soon...</p>',
                'excerpt' => '',
            ]);

            \App\Models\Reminder::createForPage(
                $page,
                "Add content to '{$title}' page",
                "The '{$title}' page was created during site setup and needs content to be added."
            );

            return response()->json([
                'success' => true,
                'message' => 'Page created successfully',
                'page_id' => $page->id,
                'edit_url' => route('admin.content-pages.edit', $page->id)
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error creating page: ' . $e->getMessage()], 500);
        }
    }

    public function completeSetup(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $user = auth()->user();
            $user->update(['needs_setup' => false]);

            return response()->json(['success' => true, 'message' => 'Setup completed']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error completing setup: ' . $e->getMessage()], 500);
        }
    }
}
