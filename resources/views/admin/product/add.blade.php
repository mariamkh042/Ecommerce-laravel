@extends('layouts.admin.admin')
@section('title','Add Product')
@section('header-title','Add Product Page')
@section('more-header')
<li class="breadcrumb-item"><a href="{{url('admin/products')}}">Product</a></li>
@endsection

@section('header','Add Product')
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
            
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">Add Product</h4>
        </div>

        <div class="card-body">
            <form action="{{url('admin/products')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($cat->count() <1)
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <a href="{{url('admin/categories/create')}}" class="btn btn-danger"> Add Category First </a>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
                @else
                <div class="row">
                    
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control">
                        @if($errors->has('name'))
                        <span class="text-red" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" name="slug" class="form-control">
                        @if($errors->has('slug'))
                        <span class="text-red" role="alert">
                            <strong>{{ $errors->first('slug') }}</strong>
                        </span>
                        @endif
                    </div>

                   
                    <div class="col-md-12 mb-3">
                        <label> Select Category</label>
                        <select class="form-control" name="category_id">
                            @foreach($cat as $item)
                            <option value="{{$item->id}}"> {{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="col-md-6 mb-3">
                        <label for="">Color Name</label>
                        <input type="text" name="color_name" class="form-control">
                        @if($errors->has('color_name'))
                        <span class="text-red" role="alert">
                            <strong>{{ $errors->first('color_name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Color Quantity</label>
                        <input type="number" name="qty" class="form-control">
                        @if($errors->has('qty'))
                        <span class="text-red" role="alert">
                            <strong>{{ $errors->first('qty') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label> Color  :</label>
                        <input type="color" name="color">
                        @error('color')
                        <span class="text-red">
                            <strong> {{$message}} </strong>
                        </span>
                        @enderror 
                    </div>
                
                    <div class="col-md-12 mb-3">
                        <label> Description </label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                        @error('description')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label> Small Description </label>
                        <input type="text" name="small_description" class="form-control">
                        @error('small_description')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Status New :</label>
                        <input type="checkbox" name="status">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Trending</label>
                        <input type="checkbox" name="trending">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label> Original Price </label>
                        <input type="number" min="1" step="any" name="original_price" class="form-control">
                        @error('original_price')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label> Selling Price </label>
                        <input type="number" min="1" step="any" name="selling_price" id="price" class="form-control">
                        @error('selling_price')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label> Offer </label>
                        <div class="input-group">
                            <input type="number" min="1" max="99" step="any" id="offer" name="offer" class="form-control">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                  <span>%</span>
                                </div>
                            </div>
                        </div>
                        @error('offer')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label> Tax </label>
                        <div class="input-group">
                            <input type="number" min="1" step="any" id="tax" name="tax" class="form-control">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                  <span>%</span>
                                </div>
                            </div>
                        </div>
                        @error('tax')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-5 mb-3">
                        The total price will be : <input type="text" id='total' name="total_price" readonly="readonly">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label> Meta Title </label>
                        <input type="text" name="meta_title" class="form-control">
                        @error('meta_title')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label> Meta Keywords </label>
                        <textarea name="meta_keywords" class="form-control" rows="3"></textarea>
                        @error('meta_keywords')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label> Meta Description </label>
                        <textarea name="meta_description" class="form-control" rows="3"></textarea>
                        @error('meta_description')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Product Image</label> <span> It is the main image of product </span>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input">
                            <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                          </div>
                        </div>
                        @error('image')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary"> Add Product </button>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
      </div>
    </div>
</div>

@endsection

@push('script')
<script type="text/javascript" src="{{asset('js/jquery-3.5.0.min')}}"></script>  
<script>
  $(document).ready(function(){
    // Get value on keyup funtion
    $("#price,#offer,#tax").keyup(function(){
        var total=0;    	
        var price = Number($("#price").val());
        var offer = Number($("#offer").val());
        var tax = Number($("#tax").val());
        var total= price -  (price * offer/100) +  (price * tax/100);    
        $('#total').val(total);
    });
});
</script>
@endpush
