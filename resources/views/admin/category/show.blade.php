@extends('layouts.admin.admin')

@section('title','Show Category')

@section('header-title','Show Category: '.$cat->name)
@section('more-header')
<li class="breadcrumb-item"><a href="{{url('admin/categories')}}">Category</a></li>
@endsection
@section('header','Show Category')
@section('content')
<section class="content">
      <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          </div>
          <div class="col-md-2 col-sm-6 col-12">
          </div>
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-primary">
              <div class="info-box-content">
                  <a href="{{url('admin/categories/'.$cat->id.'/edit')}}" type="button" class="btn btn-block btn-primary btn-lg"> <i class="fas fa-edit"></i> Edit Category {{$cat->name}} </a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
     </div>

      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Category : {{$cat->name}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <img src="{{asset('uploads/ecommerce/category/'.$cat['image'])}} " class="product-image">
                <font size="+2"><strong> Name: </strong></font> <font size='+1'> {{$cat['name']}} </font><br> 
                <font size="+2"><strong> Slug: </strong></font> <font size='+1'> {{$cat['slug']}} </font><br> 
                <font size="+2"><strong> Description: </strong></font> <font size='+1'> {{$cat['description']}} <br> 
                <font size="+2"><strong> Status New : </strong></font> <font size='+1'> {{ $cat['status'] == 1 ? "Yes":"No"}} </font><br> 
                <font size="+2"><strong> Popular : </strong></font> <font size='+1'> {{ $cat['popular'] == 1 ? "Yes":"No"}} </font><br> 
                <font size="+2"><strong> Meta Title : </strong></font> <font size='+1'> {{$cat['meta_title']  ? $cat['meta_title'] : "Nothing To Show"}}  <br> 
                <font size="+2"><strong> Meta Keywords : </strong></font> <font size='+1'> {{$cat['meta_keywords']  ? $cat['meta_keywords'] : "Nothing To Show"}}  <br> 
                <font size="+2"><strong> Meta Description : </strong></font> <font size='+1'> {{$cat['meta_descrip']  ? $cat['meta_descrip'] : "Nothing To Show"}} <br>  
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection

