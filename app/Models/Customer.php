<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Jenssegers\Agent\Agent;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property mixed $id
 * @property mixed $currentAddress
 * @property mixed $email
 */
class Customer extends Authenticatable
{
    use HasFactory, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * Generate a Sanctum token scoped to the customer's device type.
     * Replaces any existing token for the same device.
     */
    public function generateToken(): string
    {
        $agent = new Agent();

        $device = $agent->isMobile() ? 'mobile' : 'desktop';

        $tokenName = "auth-{$this->id}-{$device}";

        $this->tokens()->where('name', $tokenName)->delete();

        return $this->createToken($tokenName)->plainTextToken;
    }

    //region relation
    public function addresses(): BelongsToMany
    {
        return $this->belongsToMany(Address::class)->withPivot('current_address');
    }
    //endregion

    public function currentAddress(): Attribute
    {
        return Attribute::make(
            get: fn()=> $this->addresses()
                ->wherePivot('current_address', true)
                ->first()
        );
    }
}
