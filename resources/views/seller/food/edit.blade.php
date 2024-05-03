@php use Morilog\Jalali\Jalalian; @endphp
@extends('home.layouts.main')

@section('head-tag')
    <title>ویرایش غذا</title>
@endsection

@section('content')

    <div class="col-md-7 offset-md-2 col-lg-6 offset-lg-3 py-8 text-md-start text-center">
        <div class="mb-2">
            <h3 class="text-center">ویرایش غذا</h3>
            <a class="btn btn-secondary" href="{{ route('seller.food.index') }}">بازگشت</a>
        </div>
        <div class="card w-xxl-75">
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form action="{{ route('seller.food.update', $food) }}" method="POST"
                              enctype="multipart/form-data" class="row gx-2 gy-2 align-items-center">

                            @csrf
                            @method('PUT')

                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">نام</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control" name="name"
                                               id="name" type="text" placeholder="نام"
                                               value="{{ old('name', $food->name) }}"/>
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
                                    <label for="food_category_id" class="col-sm-3 col-form-label">دسته بندی غذا</label>
                                    <div class="col-sm-9">
                                        <div class="form-control input-box form-foodwagon-control overflow-scroll">
                                            <div class="row">
                                                @foreach($foodCategories as $foodCategory)
                                                    <div class="col-6">
                                                        <input type="checkbox" name="food_category_id[]" id="food_category_{{ $foodCategory->id }}" value="{{ $foodCategory->id }}" @if(in_array($foodCategory->id,  old('food_category_id', $food->foodCategories->pluck('id')->toArray()))) checked @endif>
                                                        <label for="food_category_{{ $foodCategory->id }}">{{ $foodCategory->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
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
                                        <input class="form-control input-box form-foodwagon-control" name="ingredient"
                                               id="ingredient" type="text" placeholder="مواد اولیه"
                                               value="{{ old('ingredient', $food->ingredient) }}"/>
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
                                    <label class="col-sm-3 col-form-label" for="price">قیمت</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control" name="price"
                                               id="price" type="text" placeholder="قیمت"
                                               value="{{ old('price', $food->price) }}"/>
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
                                        <input class="form-control input-box form-foodwagon-control" name="image"
                                               id="image" type="file" placeholder="تصویر"/>
                                        @if($food->image !== null)
                                            <img class="my-3" src="{{ asset($food->image) }}" alt="" width="100"
                                                 height="70">
                                        @endif
                                        @error('image')
                                        <span class="text-red ms-2 fs--1">
                                    {{ $message }}
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @if($food->activeDiscount)
                                <div class="input-group-icon mb-2">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="active_discount">تخفیف فعال</label>
                                        <div class="col-sm-9">
                                            <input class="form-control input-box form-foodwagon-control"
                                                   id="active_discount" type="text"
                                                   value="{{ $food->activeDiscount->percentage }}%" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group-icon mb-2">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="discount_started_at">تاریخ شروع
                                            تخفیف</label>
                                        <div class="col-sm-9">
                                            <input class="form-control input-box form-foodwagon-control"
                                                   id="discount_started_at" type="text"
                                                   value="{{ Jalalian::forge($food->activeDiscount->started_at)->format('Y-m-d') }}"
                                                   disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group-icon mb-2">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="discount_expired_at">تاریخ انقضای
                                            تخفیف</label>
                                        <div class="col-sm-9">
                                            <input class="form-control input-box form-foodwagon-control"
                                                   id="discount_expired_at" type="text"
                                                   value="{{ Jalalian::forge($food->activeDiscount->expired_at)->format('Y-m-d') }}" disabled/>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="input-group-icon mb-2">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="discount">افزودن تخفیف</label>
                                        <div class="col-sm-9">
                                            <select class="form-control input-box form-foodwagon-control" name="discount" id="discount">
                                                <option value="">لطفا در صورت تمایل تخفیف مورد نظر را انتخاب نمایید.</option>
                                                @if($discounts)
                                                    @foreach($discounts as $discount)
                                                        <option value="{{ $discount->id }}">انقضا : {{ Jalalian::forge($discount->expired_at)->format('d-m-Y') }} - آغاز : {{ Jalalian::forge($discount->started_at)->format('d-m-Y') }} - {{ $discount->percentage }}%</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('discount')
                                            <span class="text-red ms-2 fs--1">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="d-grid gap-3 w-25 mx-auto">
                                <button class="btn btn-danger text-center" type="submit">ثبت</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

