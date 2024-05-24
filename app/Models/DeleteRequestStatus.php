<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeleteRequestStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    const PENDING = 1;
    const CONFIRMED = 2;
    const REJECTED = 3;
}
