@extends('admin.layouts.main')

@section('head-tag')
    <title>بررسی درخواست حذف</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">بررسی درخواست حذف</h5>
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                <a class="btn btn-info btn-sm text-white" href="{{ route('admin.comment-delete-request.index') }}">بازگشت</a>
            </div>
                    <section class="card mb-3">
                        <section class="card-header bg-warning text-white">
                            <span>
                            نام فروشنده : {{ $commentDeleteRequest->seller->name }}
                            </span>
                            <span class="mx-5">
                                نام رستوران : {{ $commentDeleteRequest->seller->restaurant->name }}
                            </span>
                        </section>

                        <section class="card-body">
                            <h5 class="card-title">علت درخواست حذف : {{ $commentDeleteRequest->body }}</h5>
                            <section class="card-text">
                                <p>
                                متن نظر : {{ $commentDeleteRequest->comment->content }}
                                </p>
                                <p>
                                    امتیاز نظر : {{ $commentDeleteRequest->comment->score }}
                                </p>
                            </section>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.comment-delete-request.reject', $commentDeleteRequest) }}"><i class="ti ti-edit"></i> رد درخواست</a>
                            <form class="d-inline" action="{{ route('admin.comment-delete-request.confirm', $commentDeleteRequest) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm delete" onclick="return confirm('آیا از تایید درخواست و حذف کردن این نظر مطمئن هستید؟')" type="submit"><i class="ti ti-trash"></i> تایید درخواست</button>
                            </form>
                        </section>
                    </section>
        </div>
    </div>
@endsection

