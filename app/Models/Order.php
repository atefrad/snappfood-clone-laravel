<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $id
 * @property mixed $orderItems
 * @property mixed $order_status_id
 * @property mixed $orderStatus
 * @property mixed $customer_id
 * @property mixed $customer
 */
class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cart_id',
        'customer_id',
        'restaurant_id',
        'address_id',
        'payment_id',
        'order_status_id',
        'delivery_date'
    ];

    //region relation
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function foods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'order_items');
    }
    //endregion

    public function totalFoodPrice(): Attribute
    {
        $totalFoodPrice = 0;

        foreach ($this->orderItems as $orderItem)
        {
            $totalFoodPrice += $orderItem->final_total_price;
        }

        return Attribute::make(
            get: fn()=> $totalFoodPrice
        );

    }
}
