<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Malhal\Geographical\Geographical;

/**
 * @property mixed $id
 */
class Address extends Model
{
    use HasFactory, SoftDeletes, Geographical;

    protected static $kilometers = true;

    protected $fillable = [
        'title',
        'address',
        'latitude',
        'longitude',
    ];

    //region relation
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class)->withPivot('current_address');
    }
    //endregion

    public function scopeFilterCustomer(Builder $query): void
    {
        $customerId = Auth::guard('customer')->id();

        $query->whereHas('customers',
            fn(Builder $query) => $query->where('id', $customerId));
    }
}
