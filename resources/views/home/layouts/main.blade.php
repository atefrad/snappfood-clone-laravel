@include('home.partials.head-tag')

@include('home.partials.navbar')

@yield('content')

@include('home.partials.footer')

<section class="toast-wrapper flex-row-reverse">

    @include('alerts.error')
    @include('alerts.success')

</section>
