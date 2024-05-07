<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $image
 * @property mixed $id
 * @property mixed $foodCategories
 */
class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'restaurant_category_id',
        'seller_id',
        'name',
        'address',
        'phone',
        'bank_account_number',
        'image',
        'is_open',
        'delivery_price',
        ];

    protected $casts = [
        'address' => 'array',
    ];

    //region relation
    public function restaurantCategory(): BelongsTo
    {
        return $this->belongsTo(RestaurantCategory::class);
    }

    public function restaurantWorkingTime(): HasOne
    {
        return $this->hasOne(RestaurantWorkingTime::class);
    }

    public function foodCategories(): MorphToMany
    {
        return $this->morphToMany(FoodCategory::class, 'food_categoriable');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
    //endregion

    public function isActive(): Attribute
    {
        $requiredFields = [
            'restaurant_category_id',
            'name',
            'address',
            'phone',
            'bank_account_number',
        ];

        $notCompleted = array_filter($this->only($requiredFields), fn($field) => empty($field));

        return Attribute::make(
            get: fn() => empty($notCompleted)
        );
    }

    public function scopeFilterIsOpen(Builder $query): void
    {
        $isOpen = request('is_open') == 'true';

        $day =  str(now()->dayOfWeek);
        $time = now()->format('H:i:s');

        $query->when(request()->filled('is_open'), function (Builder $query) use ($day, $time, $isOpen) {
            $query->where('is_open', $isOpen)
                ->whereHas('restaurantWorkingTime',
                    fn(Builder $query) => $query->whereJsonContains('working_days', $day)
                        ->where('opening_time', '<' , $time)
                        ->where('closing_time', '>', $time));
        });
    }

    public function scopeFilterRestaurantCategory(Builder $query): void
    {
        $query->when(request()->filled('type'), function (Builder $query) {
            $query->whereHas('restaurantCategory',
                fn(Builder $query) => $query->where('name','like', ('%' . request('type') . '%')));
        });
    }
}
