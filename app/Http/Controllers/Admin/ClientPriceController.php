<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClientPriceRequest;
use App\Http\Requests\StoreClientPriceRequest;
use App\Http\Requests\UpdateClientPriceRequest;
use App\Models\ClientPrice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientPriceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('client_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClientPrice::with(['team'])->select(sprintf('%s.*', (new ClientPrice)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'client_price_show';
                $editGate      = 'client_price_edit';
                $deleteGate    = 'client_price_delete';
                $crudRoutePart = 'client-prices';

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
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('sku', function ($row) {
                return $row->sku ? $row->sku : '';
            });
            $table->editColumn('gtin', function ($row) {
                return $row->gtin ? $row->gtin : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.clientPrices.index');
    }

    public function create()
    {
        abort_if(Gate::denies('client_price_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clientPrices.create');
    }

    public function store(StoreClientPriceRequest $request)
    {
        $clientPrice = ClientPrice::create($request->all());

        return redirect()->route('admin.client-prices.index');
    }

    public function edit(ClientPrice $clientPrice)
    {
        abort_if(Gate::denies('client_price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPrice->load('team');

        return view('admin.clientPrices.edit', compact('clientPrice'));
    }

    public function update(UpdateClientPriceRequest $request, ClientPrice $clientPrice)
    {
        $clientPrice->update($request->all());

        return redirect()->route('admin.client-prices.index');
    }

    public function show(ClientPrice $clientPrice)
    {
        abort_if(Gate::denies('client_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPrice->load('team');

        return view('admin.clientPrices.show', compact('clientPrice'));
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
