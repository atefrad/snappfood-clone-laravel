<?php

namespace App\Policies\Seller;

use App\Models\Comment;
use App\Models\Seller;

class CommentPolicy
{
    public function update(Seller $seller, Comment $comment): bool
    {
        return $seller->restaurant->id === $comment->order->restaurant_id;
    }

    public function changeIsConfirmed(Seller $seller, Comment $comment): bool
    {
        return $seller->restaurant->id === $comment->order->restaurant_id;
    }

    public function createDeleteRequest(Seller $seller, Comment $comment): bool
    {
        return $seller->restaurant->id === $comment->order->restaurant_id;
    }
}
