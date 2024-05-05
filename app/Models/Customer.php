<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Jenssegers\Agent\Agent;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property mixed $id
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

    public function generateToken(): string
    {
        $agent = new Agent();

        $device = $agent->isMobile() ? 'mobile' : 'desktop';

        $tokenName = "auth-{$this->id}-{$device}";

        $this->tokens()->where('name', $tokenName)->delete();

        return $this->createToken($tokenName)->plainTextToken;
    }

    public function addresses(): BelongsToMany
    {
        return $this->belongsToMany(Address::class);
    }
}
