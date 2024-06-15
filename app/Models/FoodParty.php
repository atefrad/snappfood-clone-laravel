<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    //region relation
    public function Food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
    //endregion

    public function scopeActive(Builder $query): void
    {
        $query->where('end_date', '>', now())
            ->where('start_date', '<', now());
    }

    /**
     *
     * scope to check that foods exist
     *
     * @param Builder $query
     * @return void
     */
    public function scopeFoodExists(Builder $query): void
    {
        $query->whereHas('food',
            fn(Builder $query) => $query->whereNull('deleted_at'));
    }
}
