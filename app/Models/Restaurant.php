<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    //endregion
}
