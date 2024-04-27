@extends('admin.layouts.main')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>ایجاد دسته بندی غذا</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">ایجاد دسته بندی غذا</h5>
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                <a class="btn btn-info btn-sm text-white" href="{{ route('admin.food-category.index') }}">بازگشت</a>
                {{--                <div class="max-width-10-rem">--}}
                {{--                    <input class="form-control form-control-sm form-text" type="text" placeholder="جستجو">--}}
                {{--                </div>--}}
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.discount.store') }}" method="POST">

                        @csrf

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="percentage" class="form-label">درصد تخفیف</label>
                                <input type="text" class="form-control" name="percentage" id="percentage" value="{{ old('percentage') }}">
                                @error('percentage')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="started_at" class="form-label">تاریخ شروع</label>
                                <input type="text" class="form-control d-none" name="started_at" id="started_at" value="{{ old('started_at') }}">
                                <input class="form-control" type="text" id="started_at_view">
                                @error('started_at')
                                <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="expired_at" class="form-label">تاریخ انقضا</label>
                                <input type="text" class="form-control d-none" name="expired_at" id="expired_at" value="{{ old('expired_at') }}">
                                <input class="form-control" type="text" id="expired_at_view">
                                @error('expired_at')
                                <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-primary">ثبت</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('admin-assets/libs/jalalidatepicker/persian-date.min.js') }}"></script>
<script src="{{ asset('admin-assets/libs/jalalidatepicker/persian-datepicker.min.js') }}"></script>

<script>
    $('#started_at_view').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '#started_at'
    });

    $('#expired_at_view').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '#expired_at'
    });
</script>
@endsection

