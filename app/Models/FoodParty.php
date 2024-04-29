<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodParty extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'food_id',
      'percentage',
      'start_date',
      'end_date'
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('end_date', '>', now());
    }
}
