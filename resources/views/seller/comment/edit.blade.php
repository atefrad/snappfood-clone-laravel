@php use Morilog\Jalali\Jalalian; @endphp
@extends('home.layouts.main')

@section('head-tag')
    <title>پاسخ به نظر</title>
@endsection

@section('content')

    <div class="col-md-7 offset-md-2 col-lg-6 offset-lg-3 py-8 text-md-start text-center">
        <div class="mb-2">
            <h3 class="text-center">پاسخ به نظر</h3>
            <a class="btn btn-secondary" href="{{ route('seller.comment.index') }}">بازگشت</a>
        </div>
        <div class="card w-xxl-75">
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form action="{{ route('seller.comment.update', $comment) }}" method="POST" class="row gx-2 gy-2 align-items-center">

                            @csrf
                            @method('PUT')

                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">نام خریدار</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control"
                                               id="name" type="text" disabled
                                               value="{{  $comment->customer->name }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label for="foods" class="col-sm-3 col-form-label">غذاهای سفارش</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control"
                                               id="foods" type="text" disabled
                                               value="@foreach($comment->order->foods as $food)@if($loop->last){{ $food->name}}@else{{ $food->name . ' - ' }}@endif @endforeach"/>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="content">متن نظر</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control input-box form-foodwagon-control" id="content" disabled>{{ $comment->content }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="score">امتیاز</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control"
                                               id="score" type="text" disabled
                                               value="{{  $comment->score }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="answer">پاسخ</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control input-box form-foodwagon-control" id="answer" name="answer">{{ old('answer', $comment->answer) }}</textarea>
                                        @error('answer')
                                            <span class="text-red ms-2 fs--1">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-3 w-25 mx-auto">
                                <button class="btn btn-danger text-center" type="submit">ثبت</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

