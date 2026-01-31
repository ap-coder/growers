<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreClientPriceRequest;
use App\Http\Requests\UpdateClientPriceRequest;
use App\Http\Resources\Admin\ClientPriceResource;
use App\Models\ClientPrice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientPriceApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('api_client_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientPriceResource(ClientPrice::with(['client', 'team'])->get());
    }

    public function store(StoreClientPriceRequest $request)
    {
        $clientPrice = ClientPrice::create($request->all());

        if ($request->input('barcode_image', false)) {
            $clientPrice->addMedia(storage_path('tmp/uploads/' . basename($request->input('barcode_image'))))->toMediaCollection('barcode_image');
        }

        return (new ClientPriceResource($clientPrice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ClientPrice $clientPrice)
    {
        abort_if(Gate::denies('api_client_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientPriceResource($clientPrice->load(['client', 'team']));
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

        return (new ClientPriceResource($clientPrice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ClientPrice $clientPrice)
    {
        abort_if(Gate::denies('api_client_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPrice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
