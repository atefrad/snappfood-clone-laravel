<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $id
 * @property mixed $restaurant_id
 */
class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'restaurant_id'
    ];

    //region relation

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function foods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'cart_items')
            ->withPivot('count');
    }

    //endregion
}
