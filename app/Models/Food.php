<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $image
 * @property mixed $foodCategories
 * @property mixed $activeDiscount
 * @property mixed $restaurant_id
 * @property mixed $activeFoodParty
 * @property mixed $price
 */
class Food extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'foods';

    protected $fillable = [
        'name',
        'restaurant_id',
        'ingredient',
        'price',
        'image'
    ];

    //region relation
    public function foodCategories(): MorphToMany
    {
        return $this->morphToMany(FoodCategory::class, 'food_categoriable');
    }

    public function discounts(): BelongsToMany
    {
        return $this->belongsToMany(Discount::class);
    }

    public function foodParties(): HasMany
    {
        return $this->hasMany(FoodParty::class);
    }
    //endregion

    public function scopeFilterName(Builder $query): void
    {
        $query->when(request()->filled('name'), function (Builder $query) {

            $query->where('name', 'like', '%'. request('name') . '%');
        });
    }

    public function scopeFilterCategory(Builder $query): void
    {
        $query->when(request()->filled('food_category'), function (Builder $query) {

            $query->whereHas('foodCategories',
                fn(Builder $query) => $query->where('id', request('food_category')));
        });
    }

    public function activeDiscount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->discounts()->active()->first()
        );
    }

    public function activeFoodParty(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->foodParties()->active()->first()
        );
    }

    public function priceAfterDiscount(): Attribute
    {
        $discount = $this->activeDiscount;

        $discountPercentage = $discount ? $discount->percentage : 0;

        return Attribute::make(
            get: fn() => ((int)(100 - $discountPercentage) * (int)$this->price) / 100
        );
    }
}
