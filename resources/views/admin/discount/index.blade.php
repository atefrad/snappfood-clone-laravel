@extends('admin.layouts.main')

@section('head-tag')
    <title>تخفیف ها</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">تخفیف ها</h5>
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                <a class="btn btn-info btn-sm text-white" href="{{ route('admin.discount.create') }}">ایجاد تخفیف جدید</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">درصد تخفیف</th>
                        <th class="text-center">تاریخ شروع</th>
                        <th class="text-center">تاریخ انقضا</th>
                        <th class="max-width-16-rem text-center"><i class="fa-solid fa-gears"></i> تنظیمات</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($discounts as $key => $discount)

                        <tr>
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center">{{ $discount->percentage }}</td>
                            <td class="text-center started_at">{{ $discount->started_at }}</td>
                            <td class="text-center">{{ $discount->expired_at }}</td>
                            <td class="width-16-rem text-center">
{{--                                <a class="btn btn-primary btn-sm" href="{{ route('admin.discount.edit', $discount) }}"><i class="fa-solid fa-pen-to-square"></i> ویرایش</a>--}}
                                <form class="d-inline" action="{{ route('admin.discount.destroy', $discount) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm delete" onclick="return confirm('آیا از حذف کردن این داده مطمئن هستید؟')" type="submit"><i class="ti ti-trash"></i> حذف</button>
                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center">تخفیفی برای نمایش وجود ندارد.</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>
            {{ $discounts->links() }}
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/libs/jalalidatepicker/persian-date.min.js') }}"></script>
{{--    <script>--}}
        {{--const startedAt = new persianDate("{{ $discount->started_at }}").format('L');--}}

        {{--$('.started_at').text(startedAt);--}}
{{--    </script>--}}
@endsection
