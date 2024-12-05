<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
//        return [
//            'name' => [
//                'string',
//                'required',
//            ],
//            'categories.*' => [
//                'integer',
//            ],
//            'categories' => [
//                'array',
//            ],
//            'tags.*' => [
//                'integer',
//            ],
//            'tags' => [
//                'array',
//            ],
//            'clients.*' => [
//                'integer',
//            ],
//            'clients' => [
//                'array',
//            ],
//            'client_prices' => [
//                'array',
//                'nullable',
//            ],
//            'client_prices.*.price' => [
//                'required', 'numeric', 'min:0'
//            ],
//            'additional_photos' => [
//                'nullable', 'array',
//            ],
//            'additional_photos.*' => [
//                'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'
//            ],
//        ];
        return [];
    }


}
