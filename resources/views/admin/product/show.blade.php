@extends('layouts.admin.admin')
@section('title','Show Product')
@section('header-title','Show Product: '. $prod->name)
@section('more-header')
<li class="breadcrumb-item"><a href="{{url('admin/products')}}">Product</a></li>
@endsection

@section('header','Show Product')
@section('content')

<!-- Main content -->
 <!-- Main content -->
 <section class="content">

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3 class="d-inline-block d-sm-none">Product : {{$prod->name}} Review</h3>
            <div class="col-12">
                {{-- The Main Image --}}
              <img src="{{asset('uploads/ecommerce/product/'.$prod->image)}}" class="product-image" alt="Product Image">
            </div>

            <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="{{asset('uploads/ecommerce/product/'.$prod->image)}}" alt="Product Image"></div>
                {{-- The added images --}}
                @if(isset($prod->Img))
                @foreach($prod->Img as $item)
                <a href="{{url('admin/product/images/'.$item['id'].'/edit/'.$prod->id)}}"><i class="fa fa-edit"></i></a>
                <form action="{{url('admin/product/images/delete/'.$item['id'])}}" method="POST">
                  @csrf
                  @method("DELETE")
                <button class="btn-default fas fa-trash text-danger"></button><br>
                </form>
                <div class="product-image-thumb">
                  <img src="{{asset('uploads/ecommerce/product/'.$item['image'])}}" alt="Image">
                </div>
                @endforeach
                @endif
              </div>
              <br>
              <a href='{{url('admin/product/images/create/'.$prod->id)}}' class="btn btn-outline-primary float-right"> Add more photos</a>
          </div>

          <div class="col-12 col-sm-6">
            <h3 class="my-3">Product : {{$prod->name}} Review</h3>
            <h3 class="my-3">Of Category : {{$prod->category->name}}</h3>
            <p> {{$prod->small_description}} </p>

            <hr>

            {{-- Total Quantity --}}
            @if($prod->total_quantity($prod->id) > 0)
            <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                Total Quantity : {{$prod->total_quantity($prod->id)}}
                </h2>
            </div>
            <hr>
            @endif

             {{-- All the innformation about price of product --}}
             <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  Total Price : {{$prod->total_price}}
                </h2>
                <h4 class="mt-0">
                  <small> Tax: {{$prod->tax > 0 ?  $prod->tax."%":"No Tax"}}</small> <br>
                  <small> Offer: {{$prod->offer > 0 ?  $prod->offer."%":"No Offer"}} </small> <br>
                  <small> Original Price: {{$prod->original_price}} </small> <br>
                  <small> Selling Price: {{$prod->selling_price}} </small> <br>
                  <small> </small>
                </h4>
              </div>
              <hr>

            <h4>Available Colors</h4>
            <div class="py-2 px-3 mt-4">
                @if($prod->Color->count()>0)
                @foreach($prod->Color as $item)
                <div class="btn btn-default text-center">

                    <a href="{{url('admin/product/color/'.$item['id'].'/edit/'.$prod->id)}}"><i class="fa fa-edit"></i></a>
                    <form action="{{url('admin/product/color/delete/'.$item['id'])}}" method="POST">
                      @csrf
                      @method("DELETE")
                    <button class="btn-default fas fa-trash text-danger"></button><br>
                    </form>
                    
                    <small> Name :</small> {{$item['name']}} <br>
                    <small> Quantity :</small> {{$item['qty']}} 
                    <br>
                    <i class="fas fa-circle fa-2x" style="color:{{$item['color']}};"></i>
                </div>
                @endforeach
                @else
                <div class="alert alert-danger"> Please Add Color first</div>
                @endif
                <br>
                <br>
                <a href='{{url('admin/product/color/create/'.$prod->id)}}' class="btn btn-outline-primary" style="float:right;"> Add Color</a>
            </div>
            <br>

          </div>
        </div>
        <div class="row mt-4">
          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
              <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Other Description</a>
            </div>
          </nav>
          <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> {{$prod->description}} </div>

            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 
                <p>  Status:   {{ $prod['slug']}}  </p>
                <p>  Status New:   {{ $prod['status'] == 1 ? "Yes":"No"}}  </p>
                <p>  Trending :   {{ $prod['trending'] == 1 ? "Yes":"No"}}  </p> 
                <p>  Meta Title :   {{$prod['meta_title'] ? $prod['meta_title'] : "Nothing To Show"}} </p>     
                <p>  Meta Keywords :   {{$prod['meta_keywords'] ? $prod['meta_keywords'] : "Nothing To Show"}}  </p>   
                <p>  Meta Description :   {{$prod['meta_descrip'] ? $prod['meta_keywords'] : "Nothing To Show"}}  </p>  
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->

@endsection

@push('script')
<script>
    $(document).ready(function() {
      $('.product-image-thumb').on('click', function () {
        var $image_element = $(this).find('img')
        $('.product-image').prop('src', $image_element.attr('src'))
        $('.product-image-thumb.active').removeClass('active')
        $(this).addClass('active')
      })
    })
</script>
@endpush

