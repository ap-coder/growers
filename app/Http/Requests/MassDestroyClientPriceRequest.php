<?php

namespace App\Http\Requests;

use App\Models\ClientPrice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyClientPriceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:client_prices,id',
        ];
    }
}
