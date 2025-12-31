<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');

        return view('admin.settings.index', compact('settings'));
    }

    public function create()
    {
        abort_if(Gate::denies('setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = Setting::TYPE_SELECT;
        $groups = Setting::GROUP_SELECT;

        return view('admin.settings.create', compact('types', 'groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:settings,key',
            'label' => 'required',
            'type' => 'required',
            'group' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('value') && $request->input('type') === 'image') {
            $path = $request->file('value')->store('settings', 'public');
            $data['value'] = $path;
        }

        Setting::create($data);

        return redirect()->route('admin.settings.index')->with('message', 'Setting created successfully.');
    }

    public function edit(Setting $setting)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = Setting::TYPE_SELECT;
        $groups = Setting::GROUP_SELECT;

        return view('admin.settings.edit', compact('setting', 'types', 'groups'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'key' => 'required|unique:settings,key,' . $setting->id,
            'label' => 'required',
            'type' => 'required',
            'group' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('value') && $request->input('type') === 'image') {
            $path = $request->file('value')->store('settings', 'public');
            $data['value'] = $path;
        }

        $setting->update($data);

        return redirect()->route('admin.settings.index')->with('message', 'Setting updated successfully.');
    }

    public function destroy(Setting $setting)
    {
        abort_if(Gate::denies('setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setting->delete();

        return back()->with('message', 'Setting deleted successfully.');
    }
}
