<body dir="rtl">

<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main" id="top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" data-navbar-on-scroll="data-navbar-on-scroll">
        <div id="navbar-container" class="container">
            <a class="navbar-brand d-inline-flex" href="{{ route('home') }}">
                <img class="d-inline-block" src="{{ asset("assets/img/gallery/logo.svg") }}" alt="logo" />
                <span class="text-1000 fs-3 fw-bold ms-2 text-gradient">SnappFood Clone</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
            <div class="collapse navbar-collapse border-top border-lg-0 my-2 mt-lg-0" id="navbarSupportedContent">

                <div class="d-md-flex mt-4 mt-lg-0 ms-lg-auto ms-xl-0">
                    <div class="ms-xl-8 mb-3 mb-md-0">
                        <div class="input-group-icon pe-2"><i class="fas fa-search input-box-icon text-primary"></i>
                            <input class="form-control border-0 input-box bg-100" type="search" placeholder="جستجوی غذا" aria-label="Search" />
                        </div>
                    </div>
                    <div>
                        @auth('seller')
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('seller.orders.new-orders') }}">سفارشات</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('seller.food.index') }}">غذاها</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="@if(auth('seller')->user()->restaurant)
                                        {{ route('seller.restaurant.show', auth('seller')->user()->restaurant ) }}
                                        @else
                                        {{ route('seller.restaurant.create') }}
                                        @endif">تنظیمات</a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="#">پروفایل</a>--}}
{{--                                </li>--}}
                                <li>
                                    <form action="{{ route('seller.logout') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-white shadow-warning text-warning mx-2"> <i class="fas fa-sign-out-alt me-2"></i>خروج</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @else
                            <div class="ms-xl-7">
                                <a href="{{ route('seller.login.create') }}" class="btn btn-white shadow-warning text-warning mx-2"> <i class="fas fa-user me-2"></i>ورود</a>
                                <a href="{{ route('seller.register.create') }}" class="btn btn-white shadow-warning text-warning mx-2"> <i class="fas fa-user me-2"></i>عضویت</a>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </nav>
