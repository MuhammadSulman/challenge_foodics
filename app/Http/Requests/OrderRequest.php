<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'products' => [
                'required',
                'array',
                'min:1'
            ],
            'products.*.product_id' => [
                'required',
                'numeric',
                'exists:'.app(Product::class)->getTable().',id'
            ],
            'products.*.quantity' => [
                'required',
                'numeric',
            ]
        ];
    }
}
