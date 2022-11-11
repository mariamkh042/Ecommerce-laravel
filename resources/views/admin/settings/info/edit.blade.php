@extends('layouts.admin.admin')
@section('title','Edit Information')

@section('more-header')
<li class="breadcrumb-item"><a href="{{url('admin/settings/info')}}">Info</a></li>
@endsection

@section('header','Settings / Information')

@section ('header-title','Edit Information')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                   <div class="card-header">
                     <h3 class="card-title">Edit Info</h3>
                   </div>

                   <div class="card-body">
                   <form method="POST" action="{{url('admin/settings/info/'.$data->id)}}">
                       @method('PUT')
                       @csrf
                     <div class="row">
                         <div class="col-md-6 mb-3">
                             <label>Name Of Website</label>
                             <input type="text" name="name" class="form-control" value="{{$data->name}}"> 
                             @error('name')
                             <span class="text-red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                         </div>

                         <div class="col-md-6 mb-3">
                            <label>Mobile Phone</label>
                            <div class="input-group">
                                <input type="text" name="phone" class="form-control" value="{{$data->phone}}">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <svg width="16" height="16" fill="black">
                                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            @error('phone')
                            <span class="text-red" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                         
                         <div class="col-md-12 mb-3">
                             <label >Email Address</label>
                             <div class="input-group">
                                 <input type="email" name="email" class="form-control" id="email" value="{{$data->email}}">
                                 <div class="input-group-append">
                                     <span class="input-group-text"><span class="fas fa-envelope"></span>  </span>
                                 </div>
                                </div>
                                @error('email')
                                <span class="text-red" role="alert">
                                   <strong> {{$message}} </strong>
                                </span>
                                @enderror
                         </div>
                         
                        
                         
                         <div class="col-md-6 mb-3">
                             <label>Facebook Link</label>
                             <div class="input-group">
                                 <input type="text" name="facebook" class="form-control" value="{{$data->facebook}}">
                                 <div class="input-group-append">
                                     <span class="input-group-text"><span class="fab fa-facebook"></span>  </span>
                                 </div>
                                </div>
                                @error('facebook')
                                <span class="text-red" role="alert">
                                   <strong> {{$message}} </strong>
                                </span>
                                @enderror
                         </div>
                         
                         <div class="col-md-6 mb-3">
                             <label>Twitter Link</label>
                             <div class="input-group">
                                 <input type="text" name="twitter" class="form-control" value="{{$data->twitter}}">
                                 <div class="input-group-append">
                                     <span class="input-group-text"><span class="fab fa-twitter"></span></span>
                                 </div>
                                </div>
                                @error('twitter')
                                <span class="text-red" role="alert">
                                   <strong> {{$message}} </strong>
                                </span>
                                @enderror
                         </div>
                         
                         <div class="col-md-6 mb-3">
                             <label>Instagram Link</label>
                             <div class="input-group">
                                 <input type="text" name="instagram" class="form-control" value='{{$data->instagram}}'>
                                 <div class="input-group-append">
                                     <span class="input-group-text"><span class="fab fa-instagram"></span>  </span>
                                 </div>
                             </div>
                             @error('instagram')
                             <span class="text-red" role="alert">
                                <strong> {{$message}} </strong>
                             </span>
                             @enderror
                         </div>
             
                         <div class="col-md-6 mb-3">
                             <label>Youtube Link</label>
                             <div class="input-group">
                                 <input type="text" name="youtube" class="form-control" value="{{$data->youtube}}">
                                 <div class="input-group-append">
                                     <span class="input-group-text"><span class="fab fa-youtube"></span>  </span>
                                 </div>
                             </div>
                             @error('youtube')
                             <span class="text-red" role="alert">
                                <strong> {{$message}} </strong>
                             </span>
                             @enderror
                         </div>

                         <div class="col-md-12 mb-3">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control" value="{{$data->location}}"> 
                            @error('location')
                            <span class="text-red" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Openinig Hours</label>
                            <input type="text" name="open_hours" class="form-control" value="{{$data->open_hours}}"> 
                            @error('open_hours')
                            <span class="text-red" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                         
                     </div>
                         <!-- /.card-body -->
             
                      <div class="card-footer">
                       <input type="submit" class="btn btn-primary" value="Edit">
                       <a type="submit" href='{{url('admin/settings/info')}}' class="btn btn-default float-right">Cancel</a>
                     </div>
                     <!-- /.card-footer -->
                    </form>
                    </div>
                 </div>
      
            </div>
        </div>
        </div>
    </div>

</section>

@endsection

