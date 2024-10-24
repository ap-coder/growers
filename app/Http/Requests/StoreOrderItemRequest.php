<?php

namespace App\Http\Requests;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_item_create');
    }

    public function rules()
    {
        return [
            'gtin' => [
                'string',
                'nullable',
            ],
            'sku' => [
                'string',
                'nullable',
            ],
            'mpn' => [
                'string',
                'nullable',
            ],
            'price' => [
                'numeric',
            ],
            'quantity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'total_price' => [
                'numeric',
            ],
        ];
    }
}
