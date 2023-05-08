<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'daily_order_limit',
        'order_sort',
    ];

    protected $casts = [
        'name'                  => 'string',
        'daily_order_limit'     => 'integer',
        'order_sort'            => 'integer',
    ];
}
