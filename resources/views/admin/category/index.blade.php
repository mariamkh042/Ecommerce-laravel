@extends('layouts.admin.admin')

@push('css')
@include('inc.dataTable.dataTableCss')
@endpush

@section('title','Category')

@section('header-title','Categories Page')

@section('header','Categories Page')
@section('content')
<section class="content">
      <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-primary">
              <div class="info-box-content">
                  <a href="{{url('admin/categories/create')}}" type="button" class="btn btn-block btn-primary btn-lg"> <i class="fas fa-plus-circle"></i> Add Category </a>
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
              <h3 class="card-title">Table Of All Categories</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong>Number Of Categories are : </strong> {{$data->count()}}
              <br>
              <br>

              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $cat)
                <tr>
                  <input type="hidden" class="delete_val_id" value="{{$cat->id}}">
                  <input type="hidden" class="delete_val_name" value="{{$cat->name}}">
                  <input type="hidden" class="delete_val_token" value="{{ csrf_token() }}">

                  <td><strong> {{$loop->iteration}} </strong></td>
                  <td>{{$cat['name']}}</td>
                  <td><img src="{{asset('uploads/ecommerce/category/'.$cat->image)}}" class="profile-user-img"></td>
                  <td>
                    <a href="{{url('admin/categories/'.$cat['id'])}}"> <i class="fa fa-eye text-success fa-lg"></i></a>
                    <a href="{{url('admin/categories/'.$cat['id'].'/edit')}}"> <i class="fa fa-edit fa-lg"></i></a>
                    <a href="javascript:void(0)" class="delete_btn"><i class="fas fa-trash text-danger fa-lg"></i></a>
                  </td>
                </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection
@push('script')
<!-- DataTables  & Plugins -->
@include('inc.dataTable.dataTableFooter')

{{-- danger sweet alert --}}
{{-- To show the delete message --}}
<script>
 $(document).ready(function(){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.delete_btn').click(function(e){
    var delete_id = $(this).closest("tr").find('.delete_val_id').val();
    var cat_name = $(this).closest("tr").find('.delete_val_name').val();
    var delete_token = $(this).closest("tr").find('.delete_val_token').val(); /// ملحقتش حل غير ده من عندي مكنتش عرفة اعمل بديل لل سي.س.ر.ف. و مش عارفة؟؟

    Swal.fire({
      title: `Are you sure to delete ${cat_name} ?`,
      text: "All the attached products and images will be deleted!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    })
    .then((result) => {
      if (result.isConfirmed) {
        var data = {
          "_token": delete_token,
          'id': delete_id,
        };

        $.ajax({
          type: "DELETE",
          url: `/admin/categories/${delete_id}`,
          data: data,
          success: function(response){
            Swal.fire({
            title: response.status,
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
            })
            .then((result) => {
              location.reload();
            });

          }
        });
    }
  })
  });
 });
  
</script>
  
@endpush
