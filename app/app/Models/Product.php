<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'price',
        'stock',
    ];

    protected $casts = [
        'name'          => 'string',
        'sku'           => 'string',
        'price'         => 'double',
        'stock'         => 'integer',
    ];
}
