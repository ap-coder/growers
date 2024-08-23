<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClientPriceRequest;
use App\Http\Requests\StoreClientPriceRequest;
use App\Http\Requests\UpdateClientPriceRequest;
use App\Models\ClientPrice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientPriceController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('client_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPrices = ClientPrice::with(['team'])->get();

        return view('frontend.clientPrices.index', compact('clientPrices'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_price_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.clientPrices.create');
    }

    public function store(StoreClientPriceRequest $request)
    {
        $clientPrice = ClientPrice::create($request->all());

        return redirect()->route('frontend.client-prices.index');
    }

    public function edit(ClientPrice $clientPrice)
    {
        abort_if(Gate::denies('client_price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPrice->load('team');

        return view('frontend.clientPrices.edit', compact('clientPrice'));
    }

    public function update(UpdateClientPriceRequest $request, ClientPrice $clientPrice)
    {
        $clientPrice->update($request->all());

        return redirect()->route('frontend.client-prices.index');
    }

    public function show(ClientPrice $clientPrice)
    {
        abort_if(Gate::denies('client_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPrice->load('team');

        return view('frontend.clientPrices.show', compact('clientPrice'));
    }

    public function destroy(ClientPrice $clientPrice)
    {
        abort_if(Gate::denies('client_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPrice->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientPriceRequest $request)
    {
        $clientPrices = ClientPrice::find(request('ids'));

        foreach ($clientPrices as $clientPrice) {
            $clientPrice->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}