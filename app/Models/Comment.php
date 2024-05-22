<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $is_confirmed
 */
class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'order_id',
        'content',
        'score',
        'answer',
        'is_confirmed'
    ];

    //region relation
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    //endregion

    public function scopeFilterRestaurant(Builder $query, int $restaurantId = null): void
    {
        if($restaurantId)
        {
            $query->whereHas('order',
                fn(Builder $query) => $query->where('restaurant_id', $restaurantId));
        }
        else
        {
            $query->when(request()->filled('restaurant_id'), function (Builder $query) {
                $query->whereHas('order',
                    fn(Builder $query) => $query->where('restaurant_id', request('restaurant_id')));
            });
        }
    }

    public function scopeFilterFoodById(Builder $query): void
    {
        $query->when(request()->filled('food_id'), function (Builder $query) {
            $query->whereHas('order',
                fn(Builder $query) => $query->whereHas('foods',
                fn(Builder $query) => $query->where('foods.id', request('food_id'))
                ));
        });
    }

    public function scopeFilterFoodByName(Builder $query): void
    {
        $query->when(request()->filled('name'), function (Builder $query) {
            $query->whereHas('order',
                fn(Builder $query) => $query->whereHas('foods',
                    fn(Builder $query) => $query->where(
                        'name',
                        'like',
                        '%' . request('name') . '%'
                    )
                ));
        });
    }

    public function scopeIsConfirmed(Builder $query): void
    {
        $query->where('is_confirmed', true);
    }
}
