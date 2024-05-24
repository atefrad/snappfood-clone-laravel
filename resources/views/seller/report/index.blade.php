@php use Morilog\Jalali\Jalalian; @endphp
@extends('home.layouts.main')

@section('head-tag')
    <title>گزارشات</title>
@endsection

@section('content')
    <div class="container">
        <div class="row h-100">
            <div class="col-lg-12 mx-auto text-center mt-7">
                <h5 class="fw-bold fs-s fs-lg-5 lh-sm text-center">گزارشات</h5>
            </div>
            <section class="d-flex justify-content-between align-items-center pb-2 border-bottom section-padding">
                <a class="btn btn-secondary btn-sm text-white" href="#">نمایش نمودار ها</a>
                <div>
                    <form action="{{ route('seller.report.index') }}" class="d-flex">
                        <input class="form-control form-control-sm form-text mx-1 max-width-10-rem" type="text"
                               name="name" placeholder="نام غذا">
                        <select class="form-control form-control-sm form-text mx-1 max-width-10-rem"
                                name="food_category">
                            <option value="" selected disabled>دسته بندی</option>
                        </select>
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
                        <th class="text-center">غذاها</th>
                        <th class="text-center">وضعیت سفارش</th>
                        <th class="text-center">تاریخ ثبت</th>
                        <th class="text-center">میزان کل تخفیف</th>
                        <th class="text-center">قیمت کل غذاها بعد از تخفیف</th>
{{--                        <th class="max-width-16-rem text-center"><i class="fa-solid fa-gears"></i> تنظیمات</th>--}}
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
{{--                            <td class="width-22-rem text-end">--}}
{{--                                @if(!$order->activeFoodParty)--}}
{{--                                    <a class="btn btn-warning btn-sm"--}}
{{--                                       href="{{ route('seller.food-party.create', $order) }}"><i--}}
{{--                                            class="fas fa-edit"></i> فودپارتی</a>--}}
{{--                                @endif--}}
{{--                                <a class="btn btn-success btn-sm" href="{{ route('seller.food.edit', $order) }}"><i--}}
{{--                                        class="fas fa-edit"></i> ویرایش</a>--}}
{{--                                <form class="d-inline" action="{{ route('seller.food.destroy', $order) }}"--}}
{{--                                      method="POST">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button class="btn btn-danger btn-sm delete" type="submit"--}}
{{--                                            onclick="return confirm('آیا از حذف داده مطمئن هستید؟')"><i--}}
{{--                                            class="fas fa-trash"></i> حذف--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
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
