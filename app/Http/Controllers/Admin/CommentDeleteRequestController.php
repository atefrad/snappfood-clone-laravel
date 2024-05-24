<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CommentDeleteRequestRejected;
use App\Models\CommentDeleteRequest;
use App\Models\DeleteRequestStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentDeleteRequestController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $commentDeleteRequests = CommentDeleteRequest::query()
            ->where('delete_request_status_id', DeleteRequestStatus::PENDING)
            ->orderBy('created_at', 'desc')
            ->paginate(Controller::DEFAULT_PAGINATE);

        return view('admin.comment.delete-request.index', compact('commentDeleteRequests'));
    }

    public function show(CommentDeleteRequest $commentDeleteRequest): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.comment.delete-request.show', compact('commentDeleteRequest'));
    }

    public function reject(CommentDeleteRequest $commentDeleteRequest): RedirectResponse
    {
        $commentDeleteRequest->update([
            'delete_request_status_id' => DeleteRequestStatus::REJECTED
        ]);

        Mail::to($commentDeleteRequest->seller->email)
            ->send(new CommentDeleteRequestRejected(
                $commentDeleteRequest->seller->name,
                $commentDeleteRequest->body
            ));

        return redirect()->route('admin.comment-delete-request.index')
            ->with('toast-success', __('response.commentDeleteRequest_reject_success'));
    }

    public function confirm(CommentDeleteRequest $commentDeleteRequest)
    {
        dd('confirm');

    }
}
