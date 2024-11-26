<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyClientPriceRequest;
use App\Http\Requests\StoreClientPriceRequest;
use App\Http\Requests\UpdateClientPriceRequest;
use App\Models\Client;
use App\Models\ClientPrice;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientPriceController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('client_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClientPrice::with(['product', 'client', 'team'])->select(sprintf('%s.*', (new ClientPrice)->table));
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
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('sku', function ($row) {
                return $row->sku ? $row->sku : '';
            });
            $table->editColumn('qb_1', function ($row) {
                return $row->qb_1 ? $row->qb_1 : '';
            });
            $table->editColumn('qb_2', function ($row) {
                return $row->qb_2 ? $row->qb_2 : '';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'client']);

            return $table->make(true);
        }

        return view('admin.clientPrices.index');
    }

    public function create()
    {
        abort_if(Gate::denies('client_price_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.clientPrices.create', compact('clients', 'products'));
    }

    public function store(StoreClientPriceRequest $request)
    {
        $clientPrice = ClientPrice::create($request->all());

        if ($request->input('barcode_image', false)) {
            $clientPrice->addMedia(storage_path('tmp/uploads/' . basename($request->input('barcode_image'))))->toMediaCollection('barcode_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $clientPrice->id]);
        }

        return redirect()->route('admin.client-prices.index');
    }

    public function edit(ClientPrice $clientPrice)
    {
        abort_if(Gate::denies('client_price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clientPrice->load('product', 'client', 'team');

        return view('admin.clientPrices.edit', compact('clientPrice', 'clients', 'products'));
    }

    public function update(UpdateClientPriceRequest $request, ClientPrice $clientPrice)
    {
        $clientPrice->update($request->all());

        if ($request->input('barcode_image', false)) {
            if (! $clientPrice->barcode_image || $request->input('barcode_image') !== $clientPrice->barcode_image->file_name) {
                if ($clientPrice->barcode_image) {
                    $clientPrice->barcode_image->delete();
                }
                $clientPrice->addMedia(storage_path('tmp/uploads/' . basename($request->input('barcode_image'))))->toMediaCollection('barcode_image');
            }
        } elseif ($clientPrice->barcode_image) {
            $clientPrice->barcode_image->delete();
        }

        return redirect()->route('admin.client-prices.index');
    }

    public function show(ClientPrice $clientPrice)
    {
        abort_if(Gate::denies('client_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPrice->load('product', 'client', 'team');

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

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('client_price_create') && Gate::denies('client_price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ClientPrice();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
