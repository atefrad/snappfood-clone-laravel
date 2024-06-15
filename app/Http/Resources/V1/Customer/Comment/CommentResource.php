<?php

namespace App\Http\Resources\V1\Customer\Comment;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $comment = $this->resource;

        return [
            'id' => $comment->id,
            'author' => CustomerResource::make($comment->customer),
            'foods' => $comment->order->foods->pluck('name'),
            'created_at' => Jalalian::forge($comment->created_at)->format('Y-m-d H:i'),
            'score'=> (int)$comment->score,
            'content' => $comment->content,
            'answer' => $comment->answer
        ];
    }
}
