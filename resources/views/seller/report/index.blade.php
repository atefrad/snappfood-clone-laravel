@php use Morilog\Jalali\Jalalian; @endphp
@extends('home.layouts.main')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>گزارشات</title>
@endsection

@section('content')
    <div class="container">
        <div class="row h-100">
            <div class="col-lg-12 mx-auto text-center mt-7">
                <h5 class="fw-bold fs-s fs-lg-5 lh-sm text-center">گزارشات</h5>
            </div>
            <section class="d-flex justify-content-between align-items-center pb-2 border-bottom section-padding">
{{--                <a class="btn btn-secondary btn-sm text-white" href="#">نمایش نمودار ها</a>--}}
{{--                <div class="d-lg-flex justify-content-lg-between">--}}
                    <div class="dropdown me-3">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            فیلتر ها
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="{{ route('seller.report.index') }}">
                                    <input type="hidden" name="date" value="last_week">
                                    <input class="dropdown-item" type="submit" value="گزارش هفته گذشته">
                                </form>
                            </li>
                            <li>
                                <form action="{{ route('seller.report.index') }}">
                                    <input type="hidden" name="date" value="last_month">
                                    <input class="dropdown-item" type="submit" value="گزارش ماه گذشته">
                                </form>
                            </li>
                        </ul>
                    </div>
                    <form action="{{ route('seller.report.index') }}" class="d-flex">
                        <label class="col-form-label" for="start_date_view"> تاریخ شروع </label>
                        <input class="form-control form-control-sm form-text mx-1 max-width-10-rem d-none" type="text"
                               name="start_date" placeholder="تاریخ شروع" id="start_date">
                        <input class="form-control form-control-sm form-text mx-1 max-width-10-rem me-3" type="text"
                               placeholder="تاریخ شروع" id="start_date_view">
                        <label class="col-form-label" for="start_date_view"> تاریخ پایان </label>
                        <input class="form-control form-control-sm form-text mx-1 max-width-10-rem d-none" type="text"
                               name="end_date" placeholder="تاریخ پایان" id="end_date">
                        <input class="form-control form-control-sm form-text mx-1 max-width-10-rem" type="text"
                               placeholder="تاریخ پایان" id="end_date_view">
                        <input class="btn btn-primary" type="submit" value="اعمال فیلتر">
                    </form>
{{--                </div>--}}
            </section>

            <section class="d-flex justify-content-between align-items-center pb-0 pt-4">
                <p class="p-3 bg-twitter rounded text-white fw-bold fs--1-5">
                    تعداد کل سفارشات :
                    {{ $orderCount }}
                </p>
                <div class="d-md-flex">
                    <div class="mb-2 mx-1">
                        <a class="btn btn-success btn-sm text-white" href="{{ route('seller.report.export', ['start_date' => request('start_date'), 'date'=> request('date')]) }}">دریافت فایل اکسل</a>
                    </div>
                    <div class="mx-1">
                        <a class="btn btn-success btn-sm text-white" href="{{ route('seller.report.chart') }}">نمایش نمودار</a>
                    </div>
                </div>
                <p class="p-3 bg-twitter rounded text-white fw-bold fs--1-5">
                    درآمد کل :
                    {{ $totalIncome }}
                    تومان
                </p>
            </section>

            <section class="table-responsive table-padding">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">خریدار</th>
                        <th class="text-center">غذاها</th>
                        <th class="text-center">وضعیت سفارش</th>
                        <th class="text-center">تاریخ ثبت</th>
                        <th class="text-center">میزان کل تخفیف</th>
                        <th class="text-center">قیمت کل غذاها بعد از تخفیف</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($orders as $key => $order)

                        <tr>
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center">{{ $order->customer->name }}</td>
                            <td class="text-center">
                                <table class="table table-hover">
                                    @foreach($order->orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->food->name }}</td>
                                            <td>{{ $orderItem->count }} عدد</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td class="text-center">{{ $order->orderStatus->name }}</td>
                            <td class="text-center">{{ Jalalian::forge($order->created_at)->format('H:i Y-m-d') }}</td>
                            <td class="text-center">{{ $order->totalDiscountAmount }}</td>
                            <td class="text-center">{{ $order->totalFoodPrice }}</td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center">گزارشی برای نمایش وجود ندارد.</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
                {{ $orders->links() }}
            </section>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin-assets/libs/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/start_end_date_datepicker.js') }}"></script>
@endsection
