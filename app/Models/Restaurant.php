<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Malhal\Geographical\Geographical;

/**
 * @property mixed $image
 * @property mixed $id
 * @property mixed $foodCategories
 * @property mixed $is_open
 * @property mixed $restaurantWorkingTime
 * @property mixed $comments
 */
class Restaurant extends Model
{
    use HasFactory, SoftDeletes, Geographical;
    protected static $kilometers = true;

    protected $fillable = [
        'restaurant_category_id',
        'seller_id',
        'name',
        'address',
        'latitude',
        'longitude',
        'phone',
        'bank_account_number',
        'image',
        'is_open',
        'delivery_price',
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

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function comments(): HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, Order::class);
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

    public function realIsOpen(): Attribute
    {
        return Attribute::make(
            get: fn()=> $this->is_open && (!$this->restaurantWorkingTime || $this->restaurantWorkingTime->isWorking)
        );
    }

    /**
     * get restaurant's average score based on the customer's comment's score
     *
     * @return Attribute
     */
    public function score(): Attribute
    {
//        $count = 0;
//        $totalScore = 0;
//
//        foreach ($this->comments as $comment)
//        {
//            $totalScore += $comment->score;
//
//            $count++;
//
//        }

        $score = $this->comments()->avg('score');

        return Attribute::make(
//            get: fn()=> $count !== 0 ? $totalScore/$count : null
           get: fn()=> $score ? (float)$score : null
        );
    }

    /**
     * get restaurant's comments count
     *
     * @return Attribute
     */
    public function commentsCount(): Attribute
    {
        return Attribute::make(
            get: fn()=> $this->comments()->count()
        );
    }

    public function scopeFilterIsOpen(Builder $query): void
    {
        $isOpen = request('is_open') == 'true';

        $day =  str(now()->dayOfWeek);
        $time = now()->format('H:i:s');

        if($isOpen)
        {
            $query->when(request()->filled('is_open'), function (Builder $query) use ($day, $time, $isOpen) {
                $query->where('is_open', $isOpen)
                    ->whereHas('restaurantWorkingTime',
                        fn(Builder $query) => $query->whereJsonContains('working_days', $day)
                            ->where('opening_time', '<' , $time)
                            ->where('closing_time', '>', $time));
            });
        }
        else
        {
            $query->when(request()->filled('is_open'), function (Builder $query) use ($day, $time, $isOpen) {
                $query->where('is_open', $isOpen)
                    ->orWhereHas('restaurantWorkingTime',
                        fn(Builder $query) => $query->whereJsonDoesntContain('working_days', $day)
                            ->orWhere('opening_time', '>' , $time)
                            ->orWhere('closing_time', '<', $time));
            });
        }

    }

    public function scopeFilterRestaurantCategory(Builder $query): void
    {
        $query->when(request()->filled('type'), function (Builder $query) {
            $query->whereHas('restaurantCategory',
                fn(Builder $query) => $query->where('name','like', ('%' . request('type') . '%')));
        });
    }

    public function scopeFilterScore(Builder $query): void
    {
        $query->when(request()->filled('score_gt'), function (Builder $query) {
            $query->whereHas('comments',
                fn (Builder $query) => $query
                    ->havingRaw("AVG(score) > ?", [request('score_gt')])
            );
        });
    }
}
