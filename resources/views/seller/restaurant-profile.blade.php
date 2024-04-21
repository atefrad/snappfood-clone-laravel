@extends('layouts.main')

@section('content')
    <div class="col-md-7 offset-md-2 col-lg-6 offset-lg-3 py-8 text-md-start text-center">
        <div class="card w-xxl-75">
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <h3 class="mb-4 text-center">مشخصات رستوران</h3>
                        <form action="{{ route('seller.restaurant-profile.store') }}" method="POST" class="row gx-2 gy-2 align-items-center">

                            @csrf

                            <div class="input-group-icon mb-2">
                                <label class="visually-hidden" for="name">Name</label>
                                <input class="form-control input-box form-foodwagon-control" name="name" id="name" type="text" placeholder="نام" value="{{ old('name') }}" />
                                @error('name')
                                <span class="text-red ms-2 fs--1">
                                {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="input-group-icon mb-2">
                                <label class="visually-hidden" for="restaurant_category_id">Restaurant Category</label>
                                <input class="form-control input-box form-foodwagon-control" name="restaurant_category_id" id="restaurant_category_id" type="number" placeholder="دسته بندی رستوران" value="{{ old('restaurant_category_id') }}" />
                                @error('restaurant_category_id')
                                <span class="text-red ms-2 fs--1">
                                {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="input-group-icon mb-2">
                                <label class="visually-hidden" for="phone">Phone</label>
                                <input class="form-control input-box form-foodwagon-control" name="phone" id="phone" type="text" placeholder="شماره همراه" value="{{ old('phone') }}" />
                                @error('phone')
                                <span class="text-red ms-2 fs--1">
                                {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="input-group-icon mb-2">
                                <label class="visually-hidden" for="address">َAddress</label>
                                <input class="form-control input-box form-foodwagon-control" name="address" id="address" type="text" placeholder="آدرس" value="{{ old('address') }}"/>
                                @error('address')
                                <span class="text-red ms-2 fs--1">
                                {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="input-group-icon mb-2">
                                <label class="visually-hidden" for="bank_account_number">Bank Account Number</label>
                                <input class="form-control input-box form-foodwagon-control" name="bank_account_number" id="bank_account_number" type="text" placeholder="َشماره حساب" value="{{ old('bank_account_number') }}" />
                                @error('bank_account_number')
                                <span class="text-red ms-2 fs--1">
                                {{ $message }}
                                </span>
                                @enderror
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
@endsection

