<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $id
 * @property mixed $cart_id
 */
class CartItem extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'cart_id',
        'food_id',
        'count'
    ];

    //region relation
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
    //endregion
}
