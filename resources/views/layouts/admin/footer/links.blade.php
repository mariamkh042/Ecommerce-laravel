<script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"> </script>
<!-- jQuery -->
<script src="{{asset('admin/plugins')}}/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist')}}/js/adminlte.min.js"></script>

{{-- sweeat alert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- To show the success message --}}
@if(session('status'))
    <script>
        Swal.fire({
            icon: 'success',
            title: "{{session('status')}}",
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif

@stack('script')