@extends('layouts.admin.admin')
@section('title','Information')
@section('header','Settings / Information')
@section ('header-title','Page Information')

@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            This Information will appear in the website
          </div>


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> The Webiste, Info.
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-primary">
              <div class="col-md-10 invoice-col">
                <div class="text-center">
                    @foreach($data as $item)
                  <font size="+3"><strong> Name: </strong></font> <font size='+2'> {{$item['name']}} </font><br> 
                  <font size="+3"><strong>  Email: </strong></font> <font size='+2'> {{$item['email']}} <br> 
                  <font size="+3"><strong>  Phone: </strong></font> <font size='+2'> {{$item['phone']}}  <br> 
                  <font size="+3"><strong>  Facebook Link : </strong></font> <a href="{{$item['facebook']}}" class="text-gray"><i class="fab fa-facebook fa-2x"></i></a> <br> 
                  <font size="+3"><strong>  Twitter Link : </strong></font> <a href="{{$item['twitter']}}" class="text-gray"><i class="fab fa-twitter fa-2x"></i></a> <br> 
                  <font size="+3"><strong>  Instagram Link : </strong></font> <a href="{{$item['instagram']}}" class="text-gray"><i class="fab fa-instagram fa-2x"></i></a> <br> 
                  <font size="+3"><strong>  Youtube Link : </strong></font> <a href="{{$item['youtube']}}" class="text-gray"><i class="fab fa-youtube fa-2x"></i></a> <br> 
                  <font size="+3"><strong> Location: </strong></font> <font size='+2'> {{$item['location']}} </font><br> 
                  <font size="+3"><strong>  Open Hours: </strong></font> <font size='+2'> {{$item['open_hours']}} <br> 
                    @endforeach
                <a href="{{url('admin/settings/info/'.$item['id'].'/edit')}}" class="btn btn-primary text-white">Edit</a>
                </div>
              </div>
            </div>
            <!-- /.row -->

          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection

