@extends('layouts.admin.admin')
@section('title','Edit Color')
@section('more-header')
<li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Product</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.products.show',$prod->id)}}">Show Product</a></li>
@endsection
@section('header','Edit Color')

@section('header-title','Edit Color To Product : ' .$prod->name)


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
                  <h3 class="card-title">Edit Color to your product : {{$prod->name}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{url('admin/product/color/update/'.$color->id)}}">
                    @csrf
                    <input type="hidden" value="{{$prod->id}}" name="product_id">
                  <div class="card-body">

                    <div class="form-group">
                        <label for="name">Color Name</label>
                        <input type="text" name="name" value="{{$color->name}}" class="form-control" id="name">
                        @error('name')
                        <span class="text-red">
                            <strong> {{$message}} </strong>
                        </span>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label> Choose color  :</label>
                        <input type="color" name="color" value="{{$color->color}}">
                        @error('color')
                        <span class="text-red">
                            <strong> {{$message}} </strong>
                        </span>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label for="amount">Quantity</label>
                        <input type="number" class="form-control" id="amount" name="qty" value="{{$color->qty}}">
                        @error('qty')
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

