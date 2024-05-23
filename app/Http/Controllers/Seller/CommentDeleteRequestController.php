<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Comment\StoreCommentDeleteRequest;
use App\Models\Comment;
use App\Models\CommentDeleteRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentDeleteRequestController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function create(Comment $comment): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('createDeleteRequest', $comment);

        return view('seller.comment.delete-request.create', compact('comment'));
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreCommentDeleteRequest $request, Comment $comment): RedirectResponse
    {
        $this->authorize('createDeleteRequest', $comment);

        $validated = $request->validated();

        $sellerId = Auth::guard('seller')->id();

        CommentDeleteRequest::query()
            ->create([
                'comment_id' => $validated['comment_id'],
                'seller_id' => $sellerId,
                'delete_request_status_id' => CommentDeleteRequest::PENDING,
                'body' => $validated['body']
            ]);

        return redirect()->route('seller.comment.index')
            ->with('toast-success', __('response.commentDeleteRequest_store_success'));
    }
}
