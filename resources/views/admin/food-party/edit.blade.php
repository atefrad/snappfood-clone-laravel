@extends('admin.layouts.main')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>ویرایش فودپارتی</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">ویرایش فودپارتی</h5>
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                <a class="btn btn-info btn-sm text-white" href="{{ route('admin.food-party.index') }}">بازگشت</a>
                {{--                <div class="max-width-10-rem">--}}
                {{--                    <input class="form-control form-control-sm form-text" type="text" placeholder="جستجو">--}}
                {{--                </div>--}}
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.food-party.update', $foodParty) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="name" class="form-label">نام غذا</label>
                                <input type="text" class="form-control" id="name" value="{{ $foodParty->food->name }}" disabled>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="percentage" class="form-label">درصد تخفیف</label>
                                <input type="text" class="form-control" name="percentage" id="percentage" value="{{ old('percentage', $foodParty->percentage) }}">
                                @error('percentage')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="start_date" class="form-label">تاریخ شروع</label>
                                <input type="text" class="form-control d-none" name="start_date" id="start_date" value="{{ old('start_date', $foodParty->start_date) }}">
                                <input class="form-control" type="text" id="start_date_view" value="{{ old('start_date', $foodParty->start_date) }}">
                                @error('start_date')
                                <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="end_date" class="form-label">تاریخ پایان</label>
                                <input type="text" class="form-control d-none" name="end_date" id="end_date" value="{{ old('end_date', $foodParty->end_date) }}">
                                <input class="form-control" type="text" id="end_date_view" value="{{ old('end_date', $foodParty->end_date) }}" >
                                @error('end_date')
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
    $('#start_date_view').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '#start_date',
        initialValue: true,
    });

    $('#end_date_view').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '#end_date',
        initialValue: true,
    });
</script>
@endsection

