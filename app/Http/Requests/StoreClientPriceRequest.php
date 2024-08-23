<?php

namespace App\Http\Requests;

use App\Models\ClientPrice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClientPriceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_price_create');
    }

    public function rules()
    {
        return [
            'sku' => [
                'string',
                'nullable',
            ],
            'mpn' => [
                'string',
                'nullable',
            ],
            'gtin' => [
                'string',
                'nullable',
            ],
        ];
    }
}
