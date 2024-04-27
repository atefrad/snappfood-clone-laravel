@extends('admin.layouts.main')

@section('head-tag')
    <title>دسته بندی غذا</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">دسته بندی غذا</h5>
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                <a class="btn btn-info btn-sm text-white" href="{{ route('admin.food-category.create') }}">ایجاد دسته جدید</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">نام دسته</th>
                        <th class="text-center">توضیحات</th>
                        <th class="text-center">عکس</th>
                        <th class="max-width-16-rem text-center"><i class="fa-solid fa-gears"></i> تنظیمات</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($foodCategories as $key => $foodCategory)

                        <tr>
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center">{{ $foodCategory->name }}</td>
                            <td class="text-center max-width-20-rem">{{ $foodCategory->description }}</td>
                            <td class="text-center">
                                <img src="{{ asset($foodCategory->image) }}" alt="{{ $foodCategory->name }}" width="80" height="50">
                            </td>
                            <td class="width-16-rem text-start">
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.food-category.edit', $foodCategory) }}"><i class="ti ti-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('admin.food-category.destroy', $foodCategory) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm delete" onclick="return confirm('آیا از حذف کردن این داده مطمئن هستید؟')" type="submit"><i class="ti ti-trash"></i> حذف</button>
                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center">دسته بندی برای نمایش وجود ندارد.</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>
            {{ $foodCategories->links() }}
        </div>
    </div>
@endsection
