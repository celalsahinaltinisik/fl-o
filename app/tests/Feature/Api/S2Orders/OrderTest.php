<?php

namespace Tests\Feature\Api\S2Orders;

use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * order create
     */
    public function test_order_create()
    {
        foreach (self::$payload['order'] as $key => $product) {
            $response = $this->post(
                env('API_URL') . 'orders',
                [$product],
                ['Authorization' => "Bearer " . self::$token]
            );
            $response->assertStatus(201);
            $response->assertJsonStructure(
                [
                    "status",
                    "message",
                    "data" => [
                        "number"
                    ]
                ]
            )->assertJsonFragment(
                [
                    "status" => "Success",
                ]
            );
        }
    }
}
