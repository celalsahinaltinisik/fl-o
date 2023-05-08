<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StorageFactory extends Factory
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
            'name' => 'daily_order_limit' . fake()->numberBetween(int1:200, int2:1000),
            'name' => 'order_sort' . fake()->numberBetween(int1:1, int2:5),
        ];
    }
}
