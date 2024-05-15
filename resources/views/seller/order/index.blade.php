@extends('home.layouts.main')

@section('head-tag')
    <title>سفارشات کنونی</title>
@endsection

@section('content')
    <div class="container">
        <div class="row h-100">
            <div class="col-lg-12 mx-auto text-center mt-7">
                <h5 class="fw-bold fs-s fs-lg-5 lh-sm text-center">سفارشات کنونی</h5>
            </div>
            <section class="table-responsive table-padding">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">خریدار</th>
                        <th class="text-center">غذاها</th>
                        <th class="text-center">وضعیت سفارش</th>
                        <th class="text-center">تاریخ ثبت</th>
                        <th class="text-center">قیمت کل غذاها</th>
                        <th class="max-width-16-rem text-center"><i class="fa-solid fa-gears"></i> تنظیمات</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($newOrders as $key => $newOrder)

                        <tr>
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center">{{ $newOrder->customer->name }}</td>
                            <td class="text-center">
                                <table class="table table-hover">
                                    @foreach($newOrder->orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->food->name }}</td>
                                            <td>{{ $orderItem->count }} عدد</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td class="text-center">{{ $newOrder->orderStatus->name }}</td>
                            <td class="text-center">{{ \Morilog\Jalali\Jalalian::forge($newOrder->created_at)->format('H:i Y-m-d') }}</td>
                            <td class="text-center">{{ $newOrder->totalFoodPrice }}</td>
                            <td class="text-center">
{{--                                @if(!$newOrder->activeFoodParty)--}}
{{--                                    <a class="btn btn-warning btn-sm" href="{{ route('seller.food-party.create', $newOrder) }}"><i class="fas fa-edit"></i> فودپارتی</a>--}}
{{--                                @endif--}}
{{--                                <a class="btn btn-success btn-sm" href="{{ route('seller.order.edit', $newOrder) }}"><i class="fas fa-edit"></i> ویرایش</a>--}}
                                <form class="d-inline" action="{{ route('seller.order.destroy', $newOrder) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm delete" type="submit" onclick="return confirm('آیا از حذف داده مطمئن هستید؟')"><i class="fas fa-trash"></i> حذف</button>
                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center">سفارشی برای نمایش وجود ندارد.</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
                {{ $newOrders->links() }}
            </section>
        </div>
    </div>
@endsection
