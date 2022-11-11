@extends('layouts.admin.admin')

@push('css')
@include('inc.dataTable.dataTableCss')
@endpush

@section('title','Product')

@section('header-title','products Page')

@section('header','products Page')
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
                  <a href="{{url('admin/products/create')}}" type="button" class="btn btn-block btn-primary btn-lg"> <i class="fas fa-plus-circle"></i> Add Product </a>
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
              <h3 class="card-title">Table Of All products</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong>Number Of products are : </strong> {{$data->count()}}
              <br>
              <br>

              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Of Category</th>
                  <th>Totlal Price</th>
                  <th>Offer</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $prod)
                <tr>
                  <input type="hidden" class="delete_val_id" value="{{$prod->id}}">
                  <input type="hidden" class="delete_val_name" value="{{$prod->name}}">
                  <input type="hidden" class="delete_val_token" value="{{ csrf_token() }}">

                  <td>{{$prod['name']}}</td>
                  <td><img src="{{asset('uploads/ecommerce/product/'.$prod->image)}}" class="profile-user-img"></td>
                  <td>{{$prod->category->name}}</td>
                  <td>{{$prod['total_price']}}</td>
                  <td>
                    @if($prod->offer <0)
                    No offer
                    @elseif($prod->offer == Null)
                    No offer
                    @else
                    {{$prod['offer']}} %
                    @endif
                  </td>
                  <td>
                    <a href="{{url('admin/products/'.$prod['id'])}}"> <i class="fa fa-eye text-success fa-lg"></i></a>
                    <a href="{{url('admin/products/'.$prod['id'].'/edit')}}"> <i class="fa fa-edit fa-lg"></i></a>
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
     var prod_name = $(this).closest("tr").find('.delete_val_name').val();
     var delete_token = $(this).closest("tr").find('.delete_val_token').val(); 

     Swal.fire({
       title: `Are you sure to delete ${prod_name} ?`,
       text: "All the attached images will be deleted and order will be canceled!",
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
           url: `/admin/products/${delete_id}`,
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
