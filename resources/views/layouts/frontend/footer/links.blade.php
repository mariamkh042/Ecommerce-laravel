{{-- sweeat alert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- To show the success message --}}
@if(session('status'))
    <script>
        window.location.reload();
        Swal.fire({
            icon: 'success',
            title: "{{session('status')}}",
            showConfirmButton: false,
            timer: 3000
        })
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: "{{session('error')}}",
            showConfirmButton: false,
            timer: 3000
        })
        .then((result) => {
            window.location.reload();
        });
    </script>
@endif

<!-- jQuery Plugins -->
<script src="{{asset('frontend/js')}}/jquery.min.js"></script>
<script src="{{asset('frontend/js')}}/bootstrap.min.js"></script>
<script src="{{asset('frontend/js')}}/slick.min.js"></script>
<script src="{{asset('frontend/js')}}/nouislider.min.js"></script>
<script src="{{asset('frontend/js')}}/jquery.zoom.min.js"></script>
<script src="{{asset('frontend/js')}}/main.js"></script>

@stack('script')