<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
