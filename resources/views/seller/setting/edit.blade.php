@extends('home.layouts.main')

@section('head-tag')
    <title>ویرایش تنظیمات رستوران</title>
@endsection

@section('content')
    <div class="col-md-7 offset-md-2 col-lg-6 offset-lg-3 py-8 text-md-start text-center">
        <div class="mb-2">
            <h3 class="text-center">ویرایش تنظیمات رستوران</h3>
            <a class="btn btn-secondary" href="{{ route('seller.restaurant.show', $restaurant) }}">بازگشت</a>
        </div>
        <div class="card w-xxl-75">
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form action="{{ route('seller.restaurant.update', $restaurant) }}" method="POST" enctype="multipart/form-data" class="row gx-2 gy-2 align-items-center">

                            @csrf
                            @method('PUT')

                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">نام</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control" name="name" id="name" type="text" placeholder="نام" value="{{ old('name', $restaurant->name) }}" />
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
                                    <label for="restaurant_category_id" class="col-sm-3 col-form-label">نوع رستوران</label>
                                    <div class="col-sm-9">
                                        <select class="form-control input-box form-foodwagon-control" name="restaurant_category_id" id="restaurant_category_id">
                                            <option value="" selected disabled>لطفا دسته بندی رستوران را انتخاب نمایید.</option>
                                            @foreach($restaurantCategories as $restaurantCategory)
                                                <option value="{{ $restaurantCategory->id }}" @if($restaurantCategory->id == old('restaurant_category_id', $restaurant->restaurant_category_id)) selected @endif>{{ $restaurantCategory->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('restaurant_category_id')
                                        <span class="text-red ms-2 fs--1">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="phone">شماره تماس</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control" name="phone" id="phone" type="text" placeholder="شماره تماس" value="{{ old('phone', $restaurant->phone) }}" />
                                        @error('phone')
                                        <span class="text-red ms-2 fs--1">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="state">استان</label>
                                    <div class="col-sm-9">
                                    <input class="form-control input-box form-foodwagon-control" name="state" id="state" type="text" placeholder="استان" value="{{ old('state', $restaurant->address['state']) }}"/>
                                    @error('state')
                                    <span class="text-red ms-2 fs--1">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="city">شهر</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control" name="city" id="city" type="text" placeholder="شهر" value="{{ old('city', $restaurant->address['city']) }}"/>
                                        @error('city')
                                        <span class="text-red ms-2 fs--1">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="address">آدرس</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control" name="address" id="address" type="text" placeholder="آدرس" value="{{ old('address', $restaurant->address['address']) }}"/>
                                        @error('address')
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
                                        @if($restaurant->image !== null)
                                            <img class="my-3" src="{{ asset($restaurant->image) }}" alt="" width="100" height="70">
                                        @endif
                                        @error('image')
                                        <span class="text-red ms-2 fs--1">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="is_open">وضعیت</label>
                                    <div class="col-sm-9">
                                        <select class="form-control input-box form-foodwagon-control" name="is_open" id="is_open">
                                            <option value="0" @if(old('is_open', $restaurant->is_open) == 0 ) selected @endif>بسته</option>
                                            <option value="1" @if(old('is_open', $restaurant->is_open) == 1 ) selected @endif>باز</option>
                                        </select>
                                        @error('is_open')
                                        <span class="text-red ms-2 fs--1">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="delivery_price">هزینه ی ارسال</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control" name="delivery_price" id="delivery_price" type="text" placeholder="هزینه ی ارسال" value="{{ old('delivery_price', $restaurant->delivery_price) }}" />
                                        @error('delivery_price')
                                        <span class="text-red ms-2 fs--1">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="working_days">روزهای کاری</label>
                                    <div class="col-sm-9">
                                        <select class="form-control input-box form-foodwagon-control" name="working_days[]" id="working_days" multiple>
{{--                                            <option value="" selected disabled>لطفا روزهای کاری رستوران را انتخاب نمایید</option>--}}
                                            <option value="شنبه" @if(in_array('شنبه', old('working_days', $restaurant->restaurantWorkingTime->working_days))) selected @endif>شنبه</option>
                                            <option value="یکشنبه" @if(in_array('یکشنبه', old('working_days', $restaurant->restaurantWorkingTime->working_days))) selected @endif>یکشنبه</option>
                                            <option value="دوشنبه" @if(in_array('دوشنبه', old('working_days', $restaurant->restaurantWorkingTime->working_days))) selected @endif>دوشنبه</option>
                                            <option value="سه شنبه" @if(in_array('سه شنبه', old('working_days', $restaurant->restaurantWorkingTime->working_days))) selected @endif>سه شنبه</option>
                                            <option value="چهارشنبه" @if(in_array('چهارشنبه', old('working_days', $restaurant->restaurantWorkingTime->working_days))) selected @endif>چهارشنبه</option>
                                            <option value="پنجشنبه" @if(in_array('پنجشنبه', old('working_days', $restaurant->restaurantWorkingTime->working_days))) selected @endif>پنجشنبه</option>
                                            <option value="جمعه" @if(in_array('جمعه', old('working_days', $restaurant->restaurantWorkingTime->working_days))) selected @endif>جمعه</option>
                                        </select>
                                        @error('working_days')
                                        <span class="text-red ms-2 fs--1">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="opening_time">ساعت آغاز کار</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control" name="opening_time" id="opening_time" type="time" placeholder="ساعات کاری" value="{{ old('opening_time', $restaurant->restaurantWorkingTime->opening_time ?? '') }}" />
                                        @error('opening_time')
                                        <span class="text-red ms-2 fs--1">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="closing_time">ساعت پایان کار</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control" name="closing_time" id="closing_time" type="time" placeholder="ساعات کاری" value="{{ old('closing_time', $restaurant->restaurantWorkingTime->closing_time ?? '') }}" />
                                        @error('closing_time')
                                        <span class="text-red ms-2 fs--1">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <dphpiv class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="bank_account_number">شماره حساب</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control" name="bank_account_number" id="bank_account_number" type="text" placeholder="َشماره حساب" value="{{ old('bank_account_number', $restaurant->bank_account_number) }}" />
                                        @error('bank_account_number')
                                        <span class="text-red ms-2 fs--1">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </dphpiv>
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

