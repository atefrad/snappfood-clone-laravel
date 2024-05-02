@extends('home.layouts.main')

@section('head-tag')
    <title>snappfood-clone</title>
@endsection

@section('content')

    @include('home.components.hero')

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-4 overflow-hidden">

        <div class="container">
            <div class="row h-100">
                <div class="col-lg-12 mx-auto text-center mt-7 mb-5">
                    <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">دسته بندی ها</h5>
                </div>

                @foreach($restaurantCategories as $restaurantCategory)
                <!--            category items-->
                <div class="col-sm-6 col-lg-3 mb-3 mb-md-0 h-100 pb-4">
                    <div class="card card-span h-100">
                        <div class="position-relative">
                            <img class="img-fluid rounded-3 w-100"
                                 src="@if(is_null($restaurantCategory->image))
                                 {{ asset('images/default-category.png') }}
                                 @else
                                 {{ asset($restaurantCategory->image) }}
                                 @endif" alt="..."/>
                            <div class="card-actions">
                                <div class="badge badge-foodwagon bg-primary p-4 category-badge">
                                    <a href="">
                                        <div class="text-white fs-2">
                                            {{ $restaurantCategory->name }}
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div><!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

    @if($activeBanner)
    <section class="py-4 overflow-hidden">

        <div class="container">
            <div class="row h-100">
                <div class="text-center">
                    <a href="{{ $activeBanner->url }}">
                        <img src="{{ asset($activeBanner->image) }}" alt="">
                    </a>
                </div>
            </div>
        </div><!-- end of .container-->

    </section>
    @endif

    @include('home.partials.app-banner')

@endsection


