<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'address',
        'latitude',
        'longitude',
    ];

    //region relation
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class);
    }
    //endregion
}
