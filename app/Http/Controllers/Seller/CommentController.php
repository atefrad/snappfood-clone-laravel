<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Comment\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Seller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        /** @var Seller $seller */
        $seller = Auth::guard('seller')->user();

        $restaurantId = $seller->restaurant->id;

        $comments = Comment::query()
            ->filterRestaurant($restaurantId)
            ->filterFoodByName()
            ->orderBy('created_at', 'desc')
            ->paginate(Controller::DEFAULT_PAGINATE);

        return view('seller.comment.index', compact('comments'));
    }

    /**
     * @throws AuthorizationException
     */
    public function changeIsConfirmed(Comment $comment): RedirectResponse
    {
        $this->authorize('changeIsConfirmed', $comment);

        $isConfirmed = !$comment->is_confirmed;

        $comment->update([
            'is_confirmed' => $isConfirmed
        ]);

        if($comment->is_confirmed)
        {
            return redirect()->route('seller.comment.index')
                ->with('toast-success', __('response.comment_IsConfirmed_success'));
        }

        return redirect()->route('seller.comment.index')
            ->with('toast-success', __('response.comment_IsNotConfirmed_success'));
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Comment $comment): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('update', $comment);

        return view('seller.comment.edit', compact('comment'));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateCommentRequest $request, Comment $comment): RedirectResponse
    {
        $this->authorize('update', $comment);

        $validated = $request->validated();

        $comment->update([
            'answer' => $validated['answer']
        ]);

        return redirect()->route('seller.comment.index')
            ->with('toast-success', __('response.comment_update_success'));
    }
}
