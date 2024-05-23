@php use Morilog\Jalali\Jalalian; @endphp
@extends('home.layouts.main')

@section('head-tag')
    <title>نظرات</title>
@endsection

@section('content')
    <div class="container">
        <div class="row h-100">
            <div class="col-lg-12 mx-auto text-center mt-7">
                <h5 class="fw-bold fs-s fs-lg-5 lh-sm text-center">نظرات</h5>
            </div>
            <section class="d-flex justify-content-end align-items-center pb-2 border-bottom section-padding">
                <div>
                    <form action="{{ route('seller.comment.index') }}" class="d-flex">
                        <input class="form-control form-control-sm form-text mx-1 max-width-10-rem" type="text"
                               name="name" placeholder="نام غذا">
                        <input class="btn btn-primary" type="submit" value="جستجو">
                    </form>
                </div>
            </section>

            <section class="table-responsive table-padding">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">خریدار</th>
                        <th class="text-center">غذاهای سفارش</th>
                        <th class="text-center">متن نظر</th>
                        <th class="text-center">امتیاز</th>
                        <th class="text-center">تاریخ ارسال</th>
                        <th class="text-center">وضعیت</th>
                        <th class="max-width-16-rem text-center"><i class="fa-solid fa-gears"></i> تنظیمات</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($comments as $key => $comment)

                        <tr>
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center">{{ $comment->customer->name }}</td>
                            <td class="text-center">
                                <table class="table table-hover">
                                    @foreach($comment->order->orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->food->name }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td class="text-center max-width-20-rem">{{ $comment->content }}</td>
                            <td class="text-center">{{ $comment->score }}</td>
                            <td class="text-center">{{ Jalalian::forge($comment->created_at)->format("H:i Y-m-d") }}</td>
                            <td class="text-center">
                                @if($comment->is_confirmed)
                                    تایید شده
                                @else
                                    تایید نشده
                                @endif
                                @if($comment->commentDeleteRequest)
                                    <br>
                                    درخواست حذف <i class="fas fa-arrow-left text-danger"></i> {{ $comment->commentDeleteRequest->deleteRequestStatus->name }}
                                @endif
                            </td>
                            <td class="text-end">
                                @if($comment->is_confirmed)
                                    <a class="btn btn-warning btn-sm d-block mb-1" href="{{ route('seller.comment.change-is-confirmed', $comment) }}"><i class="fas fa-times-circle"></i> عدم تایید</a>
                                @else
                                    <a class="btn btn-warning btn-sm d-block mb-1" href="{{ route('seller.comment.change-is-confirmed', $comment) }}"><i class="fas fa-check-circle"></i> تایید</a>
                                @endif
                                <a class="btn btn-success btn-sm d-block mb-1" href="{{ route('seller.comment.edit', $comment) }}"><i class="fas fa-edit"></i> پاسخ</a>
                                <a class="btn btn-danger btn-sm d-block mb-1 @if($comment->commentDeleteRequest)disabled-link disabled @endif" href="{{ route('seller.comment-delete-request.create', $comment) }}"><i class="fas fa-trash"></i> حذف</a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center">نظری برای نمایش وجود ندارد.</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
                {{ $comments->links() }}
            </section>
        </div>
    </div>
@endsection
