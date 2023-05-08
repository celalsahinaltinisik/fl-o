<?php

namespace App\Resources\Api\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Model
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'access_token' => $this->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer',
        ];
    }
}
