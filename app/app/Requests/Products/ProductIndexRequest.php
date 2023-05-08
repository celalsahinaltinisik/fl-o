<?php

namespace App\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductIndexRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge(
            [
                'pageId' => $this->route('pageId'),
                'per_page' => $this->route('perPage')
            ]
        );
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'pageId' => 'required|integer',
            'per_page' => 'required|integer',
        ];
    }
}
