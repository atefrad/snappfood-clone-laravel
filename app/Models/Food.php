<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $image
 * @property mixed $foodCategories
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
    public function foodCategories(): BelongsToMany
    {
        return $this->belongsToMany(FoodCategory::class);
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
}
