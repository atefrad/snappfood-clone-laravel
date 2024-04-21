@extends('admin.auth.layouts.main')

@section('head-tag')
    <style>
        .form-check-input-reverse{
            margin-left: 10px;
        }
    </style>
    <title>ورود ادمین</title>
@endsection

@section('content')

    <h4 class="text-center">ورود</h4>
    <form action="{{ route('admin.login.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">ایمیل</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">رمز عبور</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
                <input class="form-check-input-reverse primary" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label text-dark" for="flexCheckChecked">
                    مرا به خاطر بسپار
                </label>
            </div>
            <a class="text-primary fw-bold" href="#">فراموشی رمز عبور؟</a>
        </div>
        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">ورود</button>
{{--        <div class="d-flex align-items-center justify-content-center">--}}
{{--            <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>--}}
{{--            <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an account</a>--}}
{{--        </div>--}}
    </form>

@endsection
