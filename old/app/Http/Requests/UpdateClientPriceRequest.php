<?php

namespace App\Http\Requests;

use App\Models\ClientPrice;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientPriceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_price_edit');
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
