<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    protected $table = 'foods';

    use HasFactory, SoftDeletes;

    public function foodCategories(): BelongsToMany
    {
        return $this->belongsToMany(FoodCategory::class, 'food_food_category');
    }
}
