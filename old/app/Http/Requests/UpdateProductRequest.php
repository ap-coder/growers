<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
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
        return [
            'name' => [
                'string',
                'required',
            ],
            'product_categories.*' => [
                'integer',
                'exists:product_categories,id', // Ensure each category exists
            ],
            'product_categories' => [
                'array',
            ],
            'tags.*' => [
                'integer',
                'exists:tags,id', // Ensure each tag exists
            ],
            'tags' => [
                'array',
            ],
            'clients.*' => [
                'integer',
                'exists:clients,id', // Ensure each client exists
            ],
            'clients' => [
                'array',
            ],
            'prices.*.price' => [
                'nullable',
                'numeric',
            ],
            'prices.*.sku' => [
                'nullable',
                'string',
            ],
            'prices.*.mpn' => [
                'nullable',
                'string',
            ],
            'prices.*.gtin' => [
                'nullable',
                'string',
            ],
            'prices.*.upc' => [
                'nullable',
                'string',
            ],
            'prices.*.qb_1' => [
                'nullable',
                'string',
            ],
            'prices.*.qb_2' => [
                'nullable',
                'string',
            ],
            'additional_photos' => [
                'array',
            ],
        ];
    }
}
