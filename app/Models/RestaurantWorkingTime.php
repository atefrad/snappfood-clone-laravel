<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $working_days
 * @property mixed $opening_time
 * @property mixed $closing_time
 */
class RestaurantWorkingTime extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'restaurant_id',
        'working_days',
        'opening_time',
        'closing_time'
    ];

    protected $casts = [
        'working_days' => 'array'
    ];

    public function isWorking(): Attribute
    {
        $day = now()->dayOfWeek;
        $time = now()->format('H:i:s');

        return Attribute::make(
            get: fn()=> in_array($day, $this->working_days) &&
                $time >= $this->opening_time &&
                $time < $this->closing_time
        );
    }
}
