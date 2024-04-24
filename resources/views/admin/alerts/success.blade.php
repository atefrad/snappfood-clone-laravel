@if(session('toast-success'))

    <section class="toast" data-bs-delay="5000">
        <section class="toast-body py-3 d-flex bg-success text-white">
            <strong class="ms-auto">{{ session('toast-success') }}</strong>

            <button type="button" class="btn-close me-2" data-bs-dismiss="toast" aria-label="close">

            </button>

        </section>

    </section>

    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        });
    </script>

@endif

