@extends('admin.layouts.main')

@section('head-tag')
    <title>رستوران ها</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">رستوران ها</h5>
{{--            <div class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">--}}
{{--                <a class="btn btn-info btn-sm text-white" href="{{ route('admin.restaurant.create') }}">ایجاد رستوران--}}
{{--                    جدید</a>--}}
{{--            </div>--}}

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">نام رستوران</th>
                        <th class="text-center">صاحب رستوران</th>
                        <th class="text-center">دسته بندی رستوران</th>
                        <th class="text-center">استان</th>
                        <th class="text-center">شماره تماس</th>
                        <th class="text-center">هزینه ارسال</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($restaurants as $key => $restaurant)

                        <tr>
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center">{{ $restaurant->name }}</td>
                            <td class="text-center">{{ $restaurant->seller->name }}</td>
                            <td class="text-center">{{ $restaurant->restaurantCategory->name }}</td>
                            <td class="text-center">{{ $restaurant->address['state'] }}</td>
                            <td class="text-center">{{ $restaurant->phone }}</td>
                            <td class="text-center">{{ $restaurant->delivery_price }}</td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center">رستورانی برای نمایش وجود ندارد.</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>
            {{ $restaurants->links() }}
        </div>
    </div>
@endsection
