<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class StockOrderRule implements InvokableRule, DataAwareRule
{
    protected $data = [];

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $index = str_replace(search: '.stock', replace: '', subject: $attribute);
        foreach ($this->data as $key => $val) {
            if (
                Product::where('id', $val['product_id'])
                ->where('stock', '<', $val['stock'])
                ->exists() && $key == $index
            ) {
                $fail(':attribute bulunamadı');
            }
        }
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}
