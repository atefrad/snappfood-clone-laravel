@extends('admin.layouts.main')

@section('head-tag')
    <title>غذا ها</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">غذا ها</h5>
{{--            <div class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">--}}
{{--                <a class="btn btn-info btn-sm text-white" href="{{ route('admin.food.create') }}">ایجاد غذا--}}
{{--                    جدید</a>--}}
{{--            </div>--}}

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">نام غذا</th>
                        <th class="text-center">نام رستوران</th>
                        <th class="text-center">دسته بندی غذا</th>
                        <th class="text-center">قیمت</th>
                        <th class="text-center">تصویر</th>
                        <th class="text-center">تخفیف فعال</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($foods as $key => $food)

                        <tr>
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center">{{ $food->name }}</td>
                            <td class="text-center">{{ $food->restaurant->name }}</td>
                            <td class="text-center">
                                @foreach($food->foodCategories as $foodCategory)
                                    @if($loop->last)
                                        {{ $foodCategory->name }}
                                    @else
                                        {{ $foodCategory->name . ' - ' }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">
                                @if($food->price === $food->priceAfterDiscount)
                                    {{ $food->price }}
                                @else
                                    <s>{{ $food->price }}</s>
                                    <br>
                                    {{ $food->priceAfterDiscount }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if(!is_null($food->image))
                                    <img src="{{ asset($food->image) }}" alt="" width="80" height="50">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="" width="100" height="80">
                                @endif
                            </td>
                            <td class="text-center">
                                @if( $food->activeDiscount)
                                    {{ $food->activeDiscount->percentage }}%
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center">غذایی برای نمایش وجود ندارد.</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>
            {{ $foods->links() }}
        </div>
    </div>
@endsection
