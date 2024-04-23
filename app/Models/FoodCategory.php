<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $image
 */
class FoodCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function getImageRealPath(): string
    {
        return substr(
            $this->image,
            strpos($this->image, '/storage')
            + strlen('/storage/')
        );
    }
}
