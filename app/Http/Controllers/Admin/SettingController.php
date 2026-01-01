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
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
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

    public function seedDummyProducts()
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            Artisan::call('db:seed', ['--class' => 'DummyProductsSeeder']);
            return redirect()->route('admin.settings.index')->with('message', 'Dummy products created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')->with('error', 'Error creating dummy products: ' . $e->getMessage());
        }
    }

    public function removeDummyProducts()
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $count = DummyProductsSeeder::removeDummyProducts();
            return redirect()->route('admin.settings.index')->with('message', "Removed {$count} dummy products successfully!");
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')->with('error', 'Error removing dummy products: ' . $e->getMessage());
        }
    }

    public function seedSettings()
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            Artisan::call('db:seed', ['--class' => 'SettingsSeeder']);
            return redirect()->route('admin.settings.index')->with('message', 'Settings seeded successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')->with('error', 'Error seeding settings: ' . $e->getMessage());
        }
    }

    public function seedDummyClients()
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            Artisan::call('db:seed', ['--class' => 'DummyClientsSeeder']);
            return redirect()->route('admin.settings.index')->with('message', 'Dummy clients created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')->with('error', 'Error creating dummy clients: ' . $e->getMessage());
        }
    }

    public function removeDummyClients()
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $count = DummyClientsSeeder::removeDummyClients();
            return redirect()->route('admin.settings.index')->with('message', "Removed {$count} dummy clients successfully!");
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')->with('error', 'Error removing dummy clients: ' . $e->getMessage());
        }
    }

    public function saveWizardSettings(Request $request)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            // Handle header logo upload
            if ($request->hasFile('header_logo')) {
                $path = $request->file('header_logo')->store('settings', 'public');
                Setting::set('company_logo', $path, 'image', 'branding', 'Company Logo', 'Main company logo for header and documents');
            }

            // Handle login image upload
            if ($request->hasFile('login_image')) {
                $path = $request->file('login_image')->store('settings', 'public');
                Setting::set('login_image', $path, 'image', 'login', 'Login Background Image', 'Background image for the login page');
            }

            // Save footer settings
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

            // Clear settings cache
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

            // Check if page with this slug already exists
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
