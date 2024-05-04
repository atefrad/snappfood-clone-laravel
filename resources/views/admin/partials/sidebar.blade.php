<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <h3 class="text-primary">
{{--                <a href="./index.html" class="text-nowrap logo-img">--}}
                    پنل ادمین
{{--                <img src="{{ asset('admin-assets/images/logos/dark-logo.svg') }}" width="180" alt="" />--}}
{{--            </a>--}}
            </h3>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="" data-simplebar-direction='rtl'>
            <ul id="sidebarnav">
{{--                <li class="nav-small-cap">--}}
{{--                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>--}}
{{--                    <span class="hide-menu">Home</span>--}}
{{--                </li>--}}
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('home') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-home"></i>
                </span>
                        <span class="hide-menu">خانه</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.home') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                        <span class="hide-menu">داشبورد</span>
                    </a>
                </li>
{{--                <li class="nav-small-cap">--}}
{{--                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>--}}
{{--                    <span class="hide-menu">UI COMPONENTS</span>--}}
{{--                </li>--}}
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.restaurant-category.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                        <span class="hide-menu">دسته بندی رستوران ها</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.food-category.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                        <span class="hide-menu">دسته بندی غذا ها</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.restaurant.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                        <span class="hide-menu">رستوران ها</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.food.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                        <span class="hide-menu">غذا ها</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.discount.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                        <span class="hide-menu">تخفیف ها</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.food-party.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                        <span class="hide-menu">فودپارتی</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.banner.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                        <span class="hide-menu">بنرها</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-typography"></i>
                </span>
                        <span class="hide-menu">نظرات</span>
                    </a>
                </li>
{{--                <li class="nav-small-cap">--}}
{{--                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>--}}
{{--                    <span class="hide-menu">AUTH</span>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">--}}
{{--                <span>--}}
{{--                  <i class="ti ti-login"></i>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu">Login</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">--}}
{{--                <span>--}}
{{--                  <i class="ti ti-user-plus"></i>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu">Register</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-small-cap">--}}
{{--                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>--}}
{{--                    <span class="hide-menu">EXTRA</span>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">--}}
{{--                <span>--}}
{{--                  <i class="ti ti-mood-happy"></i>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu">Icons</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">--}}
{{--                <span>--}}
{{--                  <i class="ti ti-aperture"></i>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu">Sample Page</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
