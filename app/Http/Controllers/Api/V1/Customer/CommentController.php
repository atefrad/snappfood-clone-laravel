<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Customer\Comment\IndexCommentRequest;
use App\Http\Requests\Api\V1\Customer\Comment\StoreCommentRequest;
use App\Http\Resources\V1\Customer\Comment\CommentResource;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    public function index(IndexCommentRequest $request)
    {
        $validated = $request->validated();

        $comments = Comment::query()
            ->filterRestaurant()
            ->filterFood()
            ->isConfirmed()
            ->paginate(Controller::DEFAULT_PAGINATE);

        return CommentResource::collection($comments);
    }

    public function store(StoreCommentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $orderId = Order::query()
            ->where('cart_id', $validated['cart_id'])
            ->first()
            ->id;

        $comment = Comment::query()->create([
            'customer_id' => $validated['customer_id'],
            'order_id' => $orderId,
            'content' => $validated['message'],
            'score' => $validated['score']
        ]);

        return response()->json([
            'message' => __('response.comment_store_success'),
            'data' => CommentResource::make($comment)
        ], Response::HTTP_OK);
    }
}
