<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accessory;
use App\Models\AccessoryType;
use App\Models\Client;
use App\Models\AccessoryClientPrice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('accessory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessories = Accessory::with('accessoryType')->get();

        return view('admin.accessories.index', compact('accessories'));
    }

    public function create()
    {
        abort_if(Gate::denies('accessory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessoryTypes = AccessoryType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.accessories.create', compact('accessoryTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'accessory_type_id' => 'required|exists:accessory_types,id',
            'name' => 'required|string|max:255',
            'base_price' => 'nullable|numeric|min:0',
        ]);

        Accessory::create($request->all());

        return redirect()->route('admin.accessories.index');
    }

    public function edit(Accessory $accessory)
    {
        abort_if(Gate::denies('accessory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessoryTypes = AccessoryType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $clients = Client::select('id', 'name')->get();
        $accessory->load('accessoryType', 'clientPrices', 'clientPrices.client');

        return view('admin.accessories.edit', compact('accessory', 'accessoryTypes', 'clients'));
    }

    public function update(Request $request, Accessory $accessory)
    {
        $request->validate([
            'accessory_type_id' => 'required|exists:accessory_types,id',
            'name' => 'required|string|max:255',
            'base_price' => 'nullable|numeric|min:0',
        ]);

        $accessory->update($request->all());

        // Handle client-specific pricing
        if ($request->has('client_prices')) {
            $clientPricesData = [];
            foreach ($request->input('client_prices') as $clientId => $priceData) {
                if (!empty($priceData['price'])) {
                    $clientPricesData[] = [
                        'accessory_id' => $accessory->id,
                        'client_id' => $clientId,
                        'price' => $priceData['price'],
                    ];
                }
            }

            if (!empty($clientPricesData)) {
                AccessoryClientPrice::upsert(
                    $clientPricesData,
                    ['accessory_id', 'client_id'],
                    ['price']
                );
            }
        }

        return redirect()->route('admin.accessories.index');
    }

    public function show(Accessory $accessory)
    {
        abort_if(Gate::denies('accessory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessory->load('accessoryType', 'clientPrices', 'clientPrices.client', 'products');

        return view('admin.accessories.show', compact('accessory'));
    }

    public function destroy(Accessory $accessory)
    {
        abort_if(Gate::denies('accessory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessory->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Accessory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
