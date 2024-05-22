<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Seller;
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
}
