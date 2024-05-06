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
                                    <label for="food_category_id" class="col-sm-3 col-form-label">دسته بندی های غذا</label>
                                    <div class="col-sm-9">
                                        <div class="form-control input-box form-foodwagon-control overflow-scroll">
                                            <div class="row">
                                            @foreach($foodCategories as $foodCategory)
                                                <div class="col-6">
                                                    <input type="checkbox" name="food_category_id[]" id="food_category_{{ $foodCategory->id }}" value="{{ $foodCategory->id }}" @if(in_array($foodCategory->id,  old('food_category_id', $foodCategoryIds))) checked @endif>
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
                                    <label class="col-sm-3 col-form-label" for="latitude">عرض جغرافیایی</label>
                                    <div class="col-sm-9">
                                    <input class="form-control input-box form-foodwagon-control ltr" name="latitude" id="latitude" type="text" placeholder="عرض جغرافیایی" value="{{ old('latitude', $restaurant->address['latitude']) }}"/>
                                    @error('latitude')
                                    <span class="text-red ms-2 fs--1">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-group-icon mb-2">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="longitude">طول جغرافیایی</label>
                                    <div class="col-sm-9">
                                        <input class="form-control input-box form-foodwagon-control ltr" name="longitude" id="longitude" type="text" placeholder="طول جغرافیایی" value="{{ old('longitude', $restaurant->address['longitude']) }}"/>
                                        @error('longitude')
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
                                        <div class="form-control input-box form-foodwagon-control overflow-scroll">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="checkbox" name="working_days[]" id="saturday" value="شنبه"  @if(in_array('شنبه', old('working_days', $restaurant->restaurantWorkingTime->working_days ?? []))) checked @endif>
                                                    <label for="saturday">شنبه</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="checkbox" name="working_days[]" id="sunday" value="یکشنبه"  @if(in_array('یکشنبه', old('working_days', $restaurant->restaurantWorkingTime->working_days ?? []))) checked @endif>
                                                    <label for="sunday">یکشنبه</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="checkbox" name="working_days[]" id="monday" value="دوشنبه"  @if(in_array('دوشنبه', old('working_days', $restaurant->restaurantWorkingTime->working_days ?? []))) checked @endif>
                                                    <label for="monday">دوشنبه</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="checkbox" name="working_days[]" id="tuesday" value="سه شنبه"  @if(in_array('سه شنبه', old('working_days', $restaurant->restaurantWorkingTime->working_days ?? []))) checked @endif>
                                                    <label for="tuesday">سه شنبه</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="checkbox" name="working_days[]" id="wednesday" value="چهارشنبه"  @if(in_array('چهارشنبه', old('working_days', $restaurant->restaurantWorkingTime->working_days ?? []))) checked @endif>
                                                    <label for="wednesday">چهارشنبه</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="checkbox" name="working_days[]" id="thursday" value="پنجشنبه"  @if(in_array('پنجشنبه', old('working_days', $restaurant->restaurantWorkingTime->working_days ?? []))) checked @endif>
                                                    <label for="thursday">پنجشنبه</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="checkbox" name="working_days[]" id="friday" value="جمعه"  @if(in_array('جمعه', old('working_days', $restaurant->restaurantWorkingTime->working_days ?? []))) checked @endif>
                                                    <label for="friday">جمعه</label>
                                                </div>
                                            </div>
                                        </div>
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

