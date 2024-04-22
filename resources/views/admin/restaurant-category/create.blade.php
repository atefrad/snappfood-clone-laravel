@extends('admin.layouts.main')

@section('head-tag')
    <title>ایجاد دسته بندی رستوران</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">ایجاد دسته بندی رستوران</h5>
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                <a class="btn btn-info btn-sm text-white" href="{{ route('admin.restaurant-category.index') }}">بازگشت</a>
                {{--                <div class="max-width-10-rem">--}}
                {{--                    <input class="form-control form-control-sm form-text" type="text" placeholder="جستجو">--}}
                {{--                </div>--}}
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.restaurant-category.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="name" class="form-label">نام دسته</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="image" class="form-label">تصویر</label>
                                <input type="file" class="form-control" name="image" id="image">
                                @error('image')
                                <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">توضیحات</label>
                                <textarea class="form-control" name="description" id="description" rows="6">
                                    {{ old('description') }}
                                </textarea>
                                @error('description')
                                <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-primary">ثبت</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

