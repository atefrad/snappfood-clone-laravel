@extends('layouts.main')

@section('head-tag')
    <title>snappfood-clone</title>
@endsection

@section('content')

@include('components.hero')

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-4 overflow-hidden">

        <div class="container">
            <div class="row h-100">
                <div class="col-lg-12 mx-auto text-center mt-7 mb-5">
                    <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">دسته بندی ها</h5>
                </div>

                <!--            category items-->
                <div class="col-sm-6 col-lg-3 mb-3 mb-md-0 h-100 pb-4">
                    <div class="card card-span h-100">
                        <div class="position-relative"> <img class="img-fluid rounded-3 w-100" src="assets/img/gallery/discount-item-1.png" alt="..." />
                            <div class="card-actions">
                                <div class="badge badge-foodwagon bg-primary p-4 category-badge">
                                    <a href="">
                                        <div class="text-white fs-2">
                                            ایرانی
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-3 mb-md-0 h-100 pb-4">
                    <div class="card card-span h-100">
                        <div class="position-relative"> <img class="img-fluid rounded-3 w-100" src="assets/img/gallery/discount-item-1.png" alt="..." />
                            <div class="card-actions">
                                <div class="badge badge-foodwagon bg-primary p-4 category-badge">
                                    <a href="">
                                        <div class="text-white fs-2">
                                            ایرانی
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-3 mb-md-0 h-100 pb-4">
                    <div class="card card-span h-100">
                        <div class="position-relative"> <img class="img-fluid rounded-3 w-100" src="assets/img/gallery/discount-item-1.png" alt="..." />
                            <div class="card-actions">
                                <div class="badge badge-foodwagon bg-primary p-4 category-badge">
                                    <a href="">
                                        <div class="text-white fs-2">
                                            ایرانی
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-3 mb-md-0 h-100 pb-4">
                    <div class="card card-span h-100">
                        <div class="position-relative"> <img class="img-fluid rounded-3 w-100" src="assets/img/gallery/discount-item-1.png" alt="..." />
                            <div class="card-actions">
                                <div class="badge badge-foodwagon bg-primary p-4 category-badge">
                                    <a href="">
                                        <div class="text-white fs-2">
                                            ایرانی
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

@include('partials.app-banner')

@endsection


