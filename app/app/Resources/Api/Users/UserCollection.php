<?php

namespace App\Resources\Api\Users;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response['users'] = $this->collection->transform(function ($data) {
            return new UserResource($data);
        });
        if ($this->resource instanceof LengthAwarePaginator) {
            $response['pagination'] = [
                'total' => $this->resource->total(),
                'lastPage' => $this->resource->lastPage(),
                'perPage' => $this->resource->perPage(),
                'currentPage' => $this->resource->currentPage(),
                'nextPageUrl' => $this->resource->nextPageUrl(),
                'previousPageUrl' => $this->resource->previousPageUrl(),
            ];
        }
        return $response;
    }
}
