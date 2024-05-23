<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentDeleteRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'comment_id',
        'seller_id',
        'delete_request_status_id',
        'body'
    ];

    const PENDING = 1;
    const CONFIRMED = 2;
    const REJECTED = 3;

    //region relation
    public function deleteRequestStatus(): BelongsTo
    {
        return $this->belongsTo(DeleteRequestStatus::class);
    }
    //endregion
}
