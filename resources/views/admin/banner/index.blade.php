@php use Morilog\Jalali\Jalalian; @endphp
@extends('admin.layouts.main')

@section('head-tag')
    <title>بنر ها</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">بنر ها</h5>
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                <a class="btn btn-info btn-sm text-white" href="{{ route('admin.banner.create') }}">ایجاد بنر
                    جدید</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">نام</th>
                        <th class="text-center">تصویر</th>
                        <th class="text-center">url</th>
                        <th class="text-center">تاریخ انقضا</th>
                        <th class="max-width-16-rem text-center"><i class="fa-solid fa-gears"></i> تنظیمات</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($banners as $key => $banner)

                        <tr>
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center">{{ $banner->name }}</td>
                            <td class="text-center">
                                <img src="{{ asset( $banner->image) }}" width="150" height="50" alt="">
                            </td>
                            <td class="text-center">{{ $banner->url }}</td>
                            <td class="text-center">{{ Jalalian::forge($banner->expired_at)->format('Y-m-d') }}</td>
                            <td class="width-16-rem text-center">
                                {{--                                <a class="btn btn-primary btn-sm" href="{{ route('admin.banner.edit', $banner) }}"><i class="fa-solid fa-pen-to-square"></i> ویرایش</a>--}}
                                <form class="d-inline" action="{{ route('admin.banner.destroy', $banner) }}"
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
                            <td colspan="8" class="text-center">بنری برای نمایش وجود ندارد.</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>
            {{ $banners->links() }}
        </div>
    </div>
@endsection
