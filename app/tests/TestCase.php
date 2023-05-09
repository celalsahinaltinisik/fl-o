<?php

namespace Tests;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public static $token = false;
    public static $payload;

    protected function setUp(): void
    {
        parent::setUp();

        $products = Product::where('stock', '>', 20)->limit(10)->latest('created_at')->get(['id AS product_id', 'stock'])->groupBy('stock')->toArray();
        self::$payload = [
            'order' => $products
        ];

        if (self::$token === false) {
            $lastTestUser = User::latest('created_at')->first();
                self::$token = $lastTestUser->createToken('auth_token')->plainTextToken;
        }
    }
}
