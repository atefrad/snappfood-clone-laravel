@extends('home.layouts.main')

@section('head-tag')
    <title>غذاها</title>
@endsection

@section('content')
    <div class="container">
        <div class="row h-100">
            <div class="col-lg-12 mx-auto text-center mt-7">
                <h5 class="fw-bold fs-s fs-lg-5 lh-sm text-center">غذاها</h5>
            </div>
            <section class="d-flex justify-content-between align-items-center pb-2 border-bottom section-padding">
                <a class="btn btn-secondary btn-sm text-white" href="{{ route('seller.food.create') }}">ایجاد غذای جدید</a>
                <div>
                    <form action="{{ route('seller.food.index') }}" class="d-flex">
                        <input class="form-control form-control-sm form-text mx-1 max-width-10-rem" type="text" name="name" placeholder="نام غذا">
                        <select class="form-control form-control-sm form-text mx-1 max-width-10-rem" name="food_category">
                            <option value="" selected disabled>دسته بندی</option>
                            @foreach($foodCategories as $foodCategory)
                                <option value="{{ $foodCategory->id }}">{{ $foodCategory->name }}</option>
                            @endforeach
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
                        <th class="text-center">نام</th>
                        <th class="text-center">دسته بندی</th>
                        <th class="text-center">مواد اولیه</th>
                        <th class="text-center">قیمت</th>
                        <th class="text-center">عکس</th>
                        <th class="max-width-16-rem text-center"><i class="fa-solid fa-gears"></i> تنظیمات</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($foods as $key => $food)

                        <tr>
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center">{{ $food->name }}</td>
                            <td class="text-center max-width-16-rem">
                                @foreach($food->foodCategories as $foodCategory)
                                    @if($loop->last)
                                        {{ $foodCategory->name }}
                                    @else
                                        {{ $foodCategory->name . ' - ' }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center max-width-20-rem">{{ $food->ingredient }}</td>
                            <td class="text-center">{{ $food->price }}</td>
                            <td class="text-center">
                                <img src="{{ asset($food->image) }}" alt="" width="80" height="50">
                            </td>
                            <td class="width-16-rem text-start">
                                <a class="btn btn-success btn-sm" href="{{ route('seller.food.edit', $food) }}"><i class="fas fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('seller.food.destroy', $food) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm delete" type="submit" onclick="return confirm('آیا از حذف داده مطمئن هستید؟')"><i class="fas fa-trash"></i> حذف</button>
                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center">غذایی برای نمایش وجود ندارد.</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </section>
            {{ $foods->links() }}
        </div>
    </div>
@endsection
