<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
