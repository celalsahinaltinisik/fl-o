<?php

namespace Tests\Feature\Api\S1Users;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * user login
     */
    public function test_login()
    {
        $response = $this->get(
            env('API_URL') . 'users'
        );
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                "status",
                "message",
                "data" => [
                    "name",
                    "access_token",
                    "token_type"
                ]
            ]
        )->assertJsonFragment(
            [
                "status" => "Success",
            ]
        );
    }
}
