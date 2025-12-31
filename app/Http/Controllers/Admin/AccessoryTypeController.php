<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessoryType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessoryTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('accessory_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessoryTypes = AccessoryType::all();

        return view('admin.accessoryTypes.index', compact('accessoryTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('accessory_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accessoryTypes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        AccessoryType::create($request->all());

        return redirect()->route('admin.accessory-types.index');
    }

    public function edit(AccessoryType $accessoryType)
    {
        abort_if(Gate::denies('accessory_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accessoryTypes.edit', compact('accessoryType'));
    }

    public function update(Request $request, AccessoryType $accessoryType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $accessoryType->update($request->all());

        return redirect()->route('admin.accessory-types.index');
    }

    public function show(AccessoryType $accessoryType)
    {
        abort_if(Gate::denies('accessory_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessoryType->load('accessories');

        return view('admin.accessoryTypes.show', compact('accessoryType'));
    }

    public function destroy(AccessoryType $accessoryType)
    {
        abort_if(Gate::denies('accessory_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessoryType->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        AccessoryType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
