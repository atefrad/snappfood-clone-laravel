<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $discount_percentage
 * @property mixed $foodPartyPercentage
 * @property mixed $food
 * @property mixed $count
 */
class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'food_id',
        'discount_id',
        'food_party_id',
        'count',
        'discount_percentage',
        'food_party_percentage',
        'final_food_price',
        'final_total_price',
    ];

    //region relation
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
    //endregion

    public function finalTotalDiscount(): Attribute
    {
        $totalDiscountPercentage = $this->discount_percentage + $this->foodPartyPercentage;

        $totalFoodDiscount = ((int)$this->food->price * (int)$totalDiscountPercentage)/100;

        return Attribute::make(
            get: fn()=> $totalFoodDiscount * $this->count
        );
    }
}
