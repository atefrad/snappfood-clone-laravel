@extends('home.layouts.main')

@section('head-tag')
    <title>تنظیمات رستوران</title>
@endsection

@section('content')
    <div class="container">
        <div class="row h-100">
            <div class="col-lg-12 mx-auto text-center mt-7 mb-5">
                <h5 class="fw-bold fs-s fs-lg-5 lh-sm text-center">تنظیمات رستوران</h5>
            </div>
            <div>
                <table class="table table-bordered border-warning table-hover table-striped">
                    <tr>
                        <th class="text-center">نام</th>
                        <td class="text-center">{{ $restaurant->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">نوع رستوران</th>
                        <td class="text-center">{{ $restaurant->restaurantCategory->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">شماره تماس</th>
                        <td class="text-center">{{ $restaurant->phone }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">استان</th>
                        <td class="text-center">{{ $restaurant->address['state'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">شهر</th>
                        <td class="text-center">{{ $restaurant->address['city'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">آدرس</th>
                        <td class="text-center">{{ $restaurant->address['address'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">شماره حساب</th>
                        <td class="text-center">{{ $restaurant->bank_account_number }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">تصویر</th>
                        <td class="text-center">
                            <img src="{{ asset($restaurant->image) }}" alt="" width="100" height="70">
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">وضعیت رستوران</th>
                        <td class="text-center">
{{--                            @if($restaurant->is_open)--}}
{{--                                باز--}}
{{--                            @else--}}
{{--                                بسته--}}
{{--                            @endif--}}
                            <form class="d-inline" action="{{ route('seller.restaurant.change-status', $restaurant) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                    @if($restaurant->is_open)
                                    <button class="btn btn-secondary mx-3">
                                        باز
                                    </button>
                                    @else
                                    <button class="btn btn-danger mx-3">
                                        بسته
                                    </button>
                                    @endif
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">هزینه ی ارسال</th>
                        <td class="text-center">{{ $restaurant->delivery_price }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">روزهای کاری</th>
                        <td class="text-center">
                            @if($restaurant->restaurantWorkingTime)
                                @foreach($restaurant->restaurantWorkingTime->working_days as $workingDay)
                                    @if($loop->last)
                                        {{ $workingDay }}
                                    @else
                                        {{ $workingDay . '-' }}
                                   @endif
                              @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">ساعت آغاز کار</th>
                        <td class="text-center">{{ $restaurant->restaurantWorkingTime->opening_time ?? ''}}</td>
                    </tr>
                    <tr>
                        <th class="text-center">ساعت پایان کار</th>
                        <td class="text-center">{{ $restaurant->restaurantWorkingTime->closing_time ?? ''}}</td>
                    </tr>
                    <tr>
                        <th class="text-center">عملیات</th>
                        <td class="text-center">
                            <a class="btn btn-success" href="{{ route('seller.restaurant.edit', $restaurant) }}">ویرایش</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
