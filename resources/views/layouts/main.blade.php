@include('partials.head-tag')

@include('partials.navbar')

@yield('content')

@include('partials.footer')

<section class="toast-wrapper flex-row-reverse">

    @include('alerts.error')
    @include('alerts.success')

</section>
