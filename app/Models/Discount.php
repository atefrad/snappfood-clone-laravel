<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'percentage',
        'started_at',
        'expired_at'
    ];

    //region relation
    public function foods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class);
    }
    //endregion

    public function scopeActive(Builder $query): void
    {
        $query->where('expired_at', '>', now());
    }
}
