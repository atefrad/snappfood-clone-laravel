@extends('home.layouts.main')

@section('head-tag')
    <title>ایجاد غذا</title>
@endsection

@section('content')

<div class="col-md-7 offset-md-2 col-lg-6 offset-lg-3 py-8 text-md-start text-center">
    <div class="mb-2">
        <h3 class="text-center">ایجاد غذای جدید</h3>
        <a class="btn btn-secondary" href="{{ route('seller.food.index') }}">بازگشت</a>
    </div>
    <div class="card w-xxl-75">
        <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <form action="{{ route('seller.food.store') }}" method="POST" enctype="multipart/form-data" class="row gx-2 gy-2 align-items-center">

                        @csrf

                        <p class="text-red">بخش هایی که با * مشخص شده اند الزامی هستند.</p>
                        <div class="input-group-icon mb-2">
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">نام<span class="text-red"> *</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control input-box form-foodwagon-control" name="name" id="name" type="text" placeholder="نام" value="{{ old('name') }}" />
                                    @error('name')
                                    <span class="text-red ms-2 fs--1">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="input-group-icon mb-2">
                            <div class="row mb-3">
                                <label for="food_category_id" class="col-sm-3 col-form-label">دسته بندی غذا<span class="text-red"> *</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control input-box form-foodwagon-control" name="food_category_id[]" id="food_category_id" multiple>
{{--                                        <option value="" selected disabled>لطفا دسته بندی غذا را انتخاب نمایید.</option>--}}
                                        @foreach($foodCategories as $foodCategory)
                                            <option value="{{ $foodCategory->id }}" @if(in_array($foodCategory->id, old('food_category_id') ?? [])) selected @endif>{{ $foodCategory->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('food_category_id')
                                    <span class="text-red ms-2 fs--1">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="input-group-icon mb-2">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="ingredient">مواد اولیه</label>
                                <div class="col-sm-9">
                                    <input class="form-control input-box form-foodwagon-control" name="ingredient" id="ingredient" type="text" placeholder="مواد اولیه" value="{{ old('ingredient') }}" />
                                    @error('ingredient')
                                    <span class="text-red ms-2 fs--1">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="input-group-icon mb-2">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="price">قیمت<span class="text-red"> *</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control input-box form-foodwagon-control" name="price" id="price" type="text" placeholder="قیمت" value="{{ old('price') }}"/>
                                    @error('price')
                                    <span class="text-red ms-2 fs--1">
                                {{ $message }}
                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="input-group-icon mb-2">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="image">تصویر</label>
                                <div class="col-sm-9">
                                    <input class="form-control input-box form-foodwagon-control" name="image" id="image" type="file" placeholder="تصویر" />
                                    @error('image')
                                    <span class="text-red ms-2 fs--1">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-3 w-25 mx-auto">
                            <button class="btn btn-danger text-center" type="submit">ثبت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



{{--    <div class="col-md-7 offset-md-2 col-lg-6 offset-lg-3 py-8 text-md-start text-center">--}}
{{--        <div class="card w-xxl-75">--}}
{{--            <div class="card-body">--}}
{{--                <div class="tab-content" id="nav-tabContent">--}}
{{--                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">--}}
{{--                        <h3 class="mb-4 text-center">ایجاد غذا</h3>--}}
{{--                        <form action="{{ route('seller.food.store') }}" method="POST" class="row gx-2 gy-2 align-items-center">--}}

{{--                            @csrf--}}

{{--                            <div class="input-group-icon mb-2">--}}
{{--                                <label class="visually-hidden" for="name">Name</label>--}}
{{--                                <input class="form-control input-box form-foodwagon-control" name="name" id="name" type="text" placeholder="نام" value="{{ old('name') }}" />--}}
{{--                                @error('name')--}}
{{--                                <span class="text-red ms-2 fs--1">--}}
{{--                                {{ $message }}--}}
{{--                                </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="input-group-icon mb-2">--}}
{{--                                <label class="visually-hidden" for="name">Name</label>--}}
{{--                                <input class="form-control input-box form-foodwagon-control" name="name" id="name" type="text" placeholder="مواد اولیه" value="{{ old('name') }}" />--}}
{{--                                @error('name')--}}
{{--                                <span class="text-red ms-2 fs--1">--}}
{{--                                {{ $message }}--}}
{{--                                </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="input-group-icon mb-2">--}}
{{--                                <label class="visually-hidden" for="restaurant_category_id">Restaurant Category</label>--}}
{{--                                <select class="form-control input-box form-foodwagon-control" name="restaurant_category_id" id="restaurant_category_id">--}}
{{--                                    <option value="" selected disabled>دسته بندی غذا</option>--}}
{{--                                    @foreach($foodCategories as $foodCategory)--}}
{{--                                        <option value="{{ $foodCategory->id }}" @if($foodCategory->id == old('restaurant_category_id')) selected @endif>{{ $foodCategory->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('restaurant_category_id')--}}
{{--                                <span class="text-red ms-2 fs--1">--}}
{{--                                {{ $message }}--}}
{{--                                </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="input-group-icon mb-2">--}}
{{--                                <label class="visually-hidden" for="phone">Phone</label>--}}
{{--                                <input class="form-control input-box form-foodwagon-control" name="phone" id="phone" type="text" placeholder="قیمت" value="{{ old('phone') }}" />--}}
{{--                                @error('phone')--}}
{{--                                <span class="text-red ms-2 fs--1">--}}
{{--                                {{ $message }}--}}
{{--                                </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="input-group-icon mb-2">--}}
{{--                                <label class="visually-hidden" for="state">State</label>--}}
{{--                                <input class="form-control input-box form-foodwagon-control" name="state" id="state" type="file" placeholder="عکس" value="{{ old('state') }}"/>--}}
{{--                                @error('state')--}}
{{--                                <span class="text-red ms-2 fs--1">--}}
{{--                                {{ $message }}--}}
{{--                                </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="d-grid gap-3 w-25 mx-auto">--}}
{{--                                <button class="btn btn-danger text-center" type="submit">ثبت</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection

