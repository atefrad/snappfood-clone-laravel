@php use Morilog\Jalali\Jalalian; @endphp
@extends('admin.layouts.main')

@section('head-tag')
    <title>فودپارتی</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">فودپارتی</h5>
{{--            <div class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">--}}
{{--                <a class="btn btn-info btn-sm text-white" href="{{ route('admin.food-party.create') }}">ایجاد تخفیف--}}
{{--                    جدید</a>--}}
{{--            </div>--}}

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">نام غذا</th>
                        <th class="text-center">درصد تخفیف</th>
                        <th class="text-center">تاریخ شروع</th>
                        <th class="text-center">تاریخ پایان</th>
                        <th class="max-width-16-rem text-center"><i class="fa-solid fa-gears"></i> تنظیمات</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($foodParties as $key => $foodParty)

                        <tr>
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center">{{ $foodParty->food->name }}</td>
                            <td class="text-center">{{ $foodParty->percentage }}</td>
                            <td class="text-center started_at">{{ Jalalian::forge($foodParty->start_date)->format('Y-m-d') }}</td>
                            <td class="text-center">{{ Jalalian::forge($foodParty->end_date)->format('Y-m-d') }}</td>
                            <td class="width-16-rem text-center">
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.food-party.edit', $foodParty) }}"><i class="ti ti-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('admin.food-party.destroy', $foodParty) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm delete"
                                            onclick="return confirm('آیا از حذف کردن این داده مطمئن هستید؟')"
                                            type="submit"><i class="ti ti-trash"></i> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center">فودپارتی برای نمایش وجود ندارد.</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>
            {{ $foodParties->links() }}
        </div>
    </div>
@endsection
