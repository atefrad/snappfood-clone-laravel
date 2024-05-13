<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $id
 * @property mixed $restaurant_id
 * @property mixed $foods
 * @property mixed $totalFoodPrice
 */
class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'restaurant_id'
    ];

    //region relation
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function foods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'cart_items')
            ->withPivot('count');
    }
    //endregion

    public function scopeActiveCart(Builder $query): void
    {
        $query->whereNull('finished_at')
            ->orderBy('created_at', 'desc');
    }

    public function totalFoodPrice(): Attribute
    {
        $totalPrice = 0;

        foreach($this->foods as $food)
        {
            $totalPrice += $food->priceAfterDiscount * $food->pivot->count;
        }

        return Attribute::make(
            get: fn()=> $totalPrice
        );
    }

    public function totalPrice():Attribute
    {
        return Attribute::make(
            get: fn()=> $this->totalFoodPrice + ($this->restaurant->delivery_price ?? 0)
        );
    }
}
