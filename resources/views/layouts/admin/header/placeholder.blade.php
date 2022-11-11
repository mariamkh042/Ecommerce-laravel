 <!-- Preloader -->
 <div class="preloader flex-column justify-content-center align-items-center">
   <img class="animation__shake"
   @if($logo->count() <1)
   src="{{asset('logo/logo.png')}}"
   @else
   src="{{asset('uploads/ecommerce/Logo/'.$logo['logo'])}}"
   @endif
    alt="AdminLTELogo" height="60" width="60">
 </div>