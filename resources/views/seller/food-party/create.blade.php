@extends('home.layouts.main')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>افزودن غذا به فودپارتی</title>
@endsection

@section('content')

<div class="col-md-7 offset-md-2 col-lg-6 offset-lg-3 py-8 text-md-start text-center">
    <div class="mb-2">
        <h3 class="text-center">افزودن غذا به فودپارتی</h3>
        <a class="btn btn-secondary" href="{{ route('seller.food.index') }}">بازگشت</a>
    </div>
    <div class="card w-xxl-75">
        <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <form action="{{ route('seller.food-party.store', $food) }}" method="POST" class="row gx-2 gy-2 align-items-center">

                        @csrf

                        <div class="input-group-icon mb-2">
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">نام غذا</label>
                                <div class="col-sm-9">
                                    <input class="form-control input-box form-foodwagon-control" id="name" type="text" value="{{ $food->name }}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="input-group-icon mb-2">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="percentage">درصد تخفیف</label>
                                <div class="col-sm-9">
                                    <input class="form-control input-box form-foodwagon-control" name="percentage" id="percentage" type="text" placeholder="درصد تخفیف" value="{{ old('percentage') }}" />
                                    @error('percentage')
                                    <span class="text-red ms-2 fs--1">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="input-group-icon mb-2">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="start_date">تاریخ شروع</label>
                                <div class="col-sm-9">
                                    <input class="form-control input-box form-foodwagon-control d-none" name="start_date" id="start_date" type="text" value="{{ old('start_date') }}"/>
                                    <input class="form-control input-box form-foodwagon-control" id="start_date_view" type="text"/>
                                    @error('start_date')
                                    <span class="text-red ms-2 fs--1">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="input-group-icon mb-2">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="end_date">تاریخ پایان</label>
                                <div class="col-sm-9">
                                    <input class="form-control input-box form-foodwagon-control d-none" name="end_date" id="end_date" type="text" value="{{ old('end_date') }}"/>
                                    <input class="form-control input-box form-foodwagon-control" id="end_date_view" type="text"/>
                                    @error('end_date')
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

@section('script')
    <script src="{{ asset('admin-assets/libs/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/start_end_date_datepicker.js') }}"></script>

{{--    <script>--}}
{{--        $('#start_date_view').persianDatepicker({--}}
{{--            observer: true,--}}
{{--            format: 'YYYY/MM/DD',--}}
{{--            altField: '#start_date'--}}
{{--        });--}}

{{--        $('#end_date_view').persianDatepicker({--}}
{{--            observer: true,--}}
{{--            format: 'YYYY/MM/DD',--}}
{{--            altField: '#end_date'--}}
{{--        });--}}
{{--    </script>--}}
@endsection

