@include('admin.partials.head-tag')

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">

    <!--  sidebar -->
    @include('admin.partials.sidebar')

    <!--  Main wrapper -->
    <div class="body-wrapper">

        <!--  Header -->
        @include('admin.partials.header')

        <div class="container-fluid">

            @yield('content')

{{--            <div class="py-6 px-6 text-center">--}}
{{--                <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>--}}
{{--            </div>--}}
        </div>
    </div>
</div>

<!--  Footer -->
@include('admin.partials.footer')

<section class="toast-wrapper flex-row-reverse">

    @include('admin.alerts.error')
    @include('admin.alerts.success')

</section>


