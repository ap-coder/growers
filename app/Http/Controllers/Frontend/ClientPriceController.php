<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyClientPriceRequest;
use App\Http\Requests\StoreClientPriceRequest;
use App\Http\Requests\UpdateClientPriceRequest;
use App\Models\ClientPrice;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ClientPriceController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('client_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPrices = ClientPrice::with(['team', 'media'])->get();

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

        if ($request->input('barcode_image', false)) {
            $clientPrice->addMedia(storage_path('tmp/uploads/' . basename($request->input('barcode_image'))))->toMediaCollection('barcode_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $clientPrice->id]);
        }

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
