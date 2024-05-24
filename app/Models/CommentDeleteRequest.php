<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $seller
 * @property mixed $body
 */
class CommentDeleteRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'comment_id',
        'seller_id',
        'delete_request_status_id',
        'body'
    ];

    //region relation
    public function deleteRequestStatus(): BelongsTo
    {
        return $this->belongsTo(DeleteRequestStatus::class);
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
    //endregion
}
