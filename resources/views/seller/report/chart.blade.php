@extends('home.layouts.main')

@section('head-tag')
    <title>نمایش نمودار</title>
@endsection

@section('content')
    <div class="container">
        <div class="row h-100">
            <div class="col-lg-12 mx-auto text-center mt-7">
                <h5 class="fw-bold fs-s fs-lg-5 lh-sm text-center">نمایش نمودار</h5>
            </div>

            <div class="container px-4 mx-auto">
                <div class="p-6 bg-white rounded shadow w-90 mx-auto mt-2">
                    {!! $chart->container() !!}
                    <p class="text-center fw-bold fs-2 pt-3">نمودار تعداد سفارشات</p>
                </div>
                <div class="p-6 bg-white rounded shadow w-90 mx-auto mt-2">
                    {!! $chart2->container() !!}
                    <p class="text-center fw-bold fs-2 pt-3">نمودار میزان درآمد</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    {{ $chart2->script() }}
@endsection
