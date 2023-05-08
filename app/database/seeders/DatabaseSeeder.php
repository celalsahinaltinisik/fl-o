<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\Storage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();

        $products = Product::factory(100)->create();
        $storages = Storage::factory(10)->create();
        $products->each(function ($product) use ($storages) {
            $product->storages()->attach(fake()->randomElements($storages->pluck('id'), 2));
            // Random ürün depo ilişkisi
        });
    }
}
