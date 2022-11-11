@extends('layouts.admin.admin')
@section('title','Edit Product')
@section('header-title','Edit Product :'.$prod->name)
@section('more-header')
<li class="breadcrumb-item"><a href="{{url('admin/products')}}">Products</a></li>
@endsection

@section('header','Edit Product')
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <div class="card card-primary">
                  <div class="card-header">
                      <h4 class="card-title">Edit Product : {{$prod->name}}</h4>
                  </div>
          
                  <div class="card-body">
                      <form action="{{url('admin/products/'.$prod->id)}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="row">
                              <div class="col-md-6 mb-3">
                                  <label for="">Name</label>
                                  <input type="text" name="name" class="form-control" value="{{$prod->name}}">
                                  @if($errors->has('name'))
                                  <span class="text-red" role="alert">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                                  @endif
                              </div>
          
                              <div class="col-md-6 mb-3">
                                  <label for="">Slug</label>
                                  <input type="text" name="slug" class="form-control" value="{{$prod->slug}}">
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
                                      <option {{ $prod->category_id === $item->id ? "selected":"" }} value="{{$item->id}}"> {{$item->name}} </option>
                                      @endforeach
                                  </select>
                                  @if($errors->has('category_id'))
                                  <span class="text-red" role="alert">
                                      <strong>{{ $errors->first('category_id') }}</strong>
                                  </span>
                                  @endif
                              </div>
                          
                              <div class="col-md-12 mb-3">
                                  <label> Description </label>
                                  <textarea name="description" class="form-control" rows="3">{{$prod->description}}</textarea>
                                  @error('description')
                                  <span class="text-red" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
          
                              <div class="col-md-12 mb-3">
                                  <label> Small Description </label>
                                  <input name="small_description" class="form-control" value="{{$prod->small_description}}">
                                  @error('small_description')
                                  <span class="text-red" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
          
                              <div class="col-md-6 mb-3">
                                  <label for="">Status : New</label>
                                  <input type="checkbox" name="status" {{$prod->status == "1" ? "checked":""}}>
                              </div>
          
                              <div class="col-md-6 mb-3">
                                  <label for="">Trending</label>
                                  <input type="checkbox" name="trending" {{$prod->trending == "1" ? "checked":""}}>
                              </div>
          
                              <div class="col-md-6 mb-3">
                                  <label> Original Price </label>
                                  <input type="number" min="1" step="any" name="original_price" class="form-control" value="{{$prod->original_price}}">
                                  @error('original_price')
                                  <span class="text-red" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
          
                              <div class="col-md-6 mb-3">
                                  <label> Selling Price </label>
                                  <input type="number" min="1" step="any" name="selling_price" id="price" class="form-control" value="{{$prod->selling_price}}">
                                  @error('selling_price')
                                  <span class="text-red" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
          
                              <div class="col-md-6 mb-3">
                                  <label> Offer </label>
                                  <div class="input-group">
                                      <input type="number" min="1" max="99" step="any" id="offer" name="offer" class="form-control" value="{{$prod->offer}}">
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
                                      <input type="number" min="1" step="any" id="tax" name="tax" class="form-control" value="{{$prod->tax}}">
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
                                  The total price will be : <input type="text" id='total' name="total_price" readonly="readonly" value="{{$prod->total_price}}">
                              </div>
          
                              <div class="col-md-12 mb-3">
                                  <label> Meta Title </label>
                                  <input type="text" name="meta_title" class="form-control" value="{{$prod->meta_title}}">
                                  @error('meta_title')
                                  <span class="text-red" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
          
                              <div class="col-md-12 mb-3">
                                  <label> Meta Keywords </label>
                                  <textarea name="meta_keywords" class="form-control" rows="3"> {{$prod->meta_keywords}} </textarea>
                                  @error('meta_keywords')
                                  <span class="text-red" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
          
                              <div class="col-md-12 mb-3">
                                  <label> Meta Description </label>
                                  <textarea name="meta_description" class="form-control" rows="3">{{$prod->meta_description}}</textarea>
                                  @error('meta_descrip')
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
                                      <strong>{{ $errors->first('image') }}</strong>
                                  </span>
                                  @enderror
                              </div>
          
                              <div class="col-md-12">
                                  <button type="submit" class="btn btn-primary"> Edit Product </button>
                              </div>
                          </div>
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
