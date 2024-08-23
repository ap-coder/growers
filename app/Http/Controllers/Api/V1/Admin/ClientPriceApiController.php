<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientPriceRequest;
use App\Http\Requests\UpdateClientPriceRequest;
use App\Http\Resources\Admin\ClientPriceResource;
use App\Models\ClientPrice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientPriceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('client_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientPriceResource(ClientPrice::with(['team'])->get());
    }

    public function store(StoreClientPriceRequest $request)
    {
        $clientPrice = ClientPrice::create($request->all());

        return (new ClientPriceResource($clientPrice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ClientPrice $clientPrice)
    {
        abort_if(Gate::denies('client_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientPriceResource($clientPrice->load(['team']));
    }

    public function update(UpdateClientPriceRequest $request, ClientPrice $clientPrice)
    {
        $clientPrice->update($request->all());

        return (new ClientPriceResource($clientPrice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ClientPrice $clientPrice)
    {
        abort_if(Gate::denies('client_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientPrice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
