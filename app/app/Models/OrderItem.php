<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'storage_id',
        'price',
        'stock',
    ];

    protected $casts = [
        'order_id'      => 'integer',
        'product_id'    => 'integer',
        'storage_id'    => 'integer',
        'price'         => 'double',
        'stock'         => 'integer',
    ];

    /**
     * Get the order associated with the orderitem.
     */
    public function order(): HasOne
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    /**
     * Get the product associated with the orderitem.
     */
    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
