@extends('layouts.admin.admin')
@section('title','Edit Image')
@section('more-header')
<li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Product</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.products.show',$prod->id)}}">Show Product</a></li>
@endsection
@section('header','Edit Image')

@section('header-title','Edit Image To Product : ' .$prod->name)

@section('content')
    <!-- Main content -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    
             <!-- Horizontal Form -->
             <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit image to your product : {{$prod->name}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{url('admin/product/images/update/'.$img->id)}}" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" value="{{$prod->id}}" name="product_id">
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputFile">Product Image</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                          </div>
                        </div>
                        @error('image')
                        <br>
                        <span class="text-red">
                          <strong> {{$message}} </strong>
                        </span>
                        @enderror
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Edit">
                    <a type="submit" href='{{url('admin/products/'.$prod['id'])}}' class="btn btn-default float-right">Cancel</a>
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection

