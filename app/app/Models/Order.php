<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'user_id',
        'total_price',
    ];

    protected $casts = [
        'number'        => 'string',
        'user_id'       => 'integer',
        'total_price'   => 'double',
    ];

    /**
     * generate order number.
     */
    public static function generateOrderNumber(): string
    {
        return '#' . Str::random(20);
    }


    /**
     * Get the orderitem associated with the order.
     */
    public function orderItem(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    /**
     * Get the user associated with the order.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
