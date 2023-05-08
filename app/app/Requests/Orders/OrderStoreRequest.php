<?php

namespace App\Requests\Orders;

use App\Rules\StockOrderRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            '*.product_id' => 'required|exists:products,id',
            '*.stock'      => [
                'required',
                'integer',
                new StockOrderRule()
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            '*.product_id.required' => 'Ürün id boş geçilemez',
            '*.product_id.exists' => 'Ürün bulunamadı',
            '*.stock.required' => 'Stock boş geçilemez',
            '*.stock.integer' => 'Stock boş sayı olmalı',
        ];
    }
}
