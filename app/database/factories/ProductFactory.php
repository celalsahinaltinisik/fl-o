<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'storage_test_' . fake()->name(),
            'sku' =>  Str::random(10),
            'price' => fake()->randomFloat(nbMaxDecimals:2, min:20, max:100),
            'stock' => fake()->numberBetween(int1:10, int2:30),
        ];
    }
}
