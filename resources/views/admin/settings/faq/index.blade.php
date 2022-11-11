@extends('layouts.admin.admin')
@section('title','FAQ')
@section('header','FAQ')
@section('header-title','Frequently asked questions')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12" id="accordion">
            @if($data->count()<1)
            <div class="card card-primary">
                <div class="card-header">
                    <h3> FAQ </h3>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="card-title">Please add the question and answer first</h4> <br>
                        <a href="{{url('admin/settings/faq/create')}}" class="btn btn-primary"> Add </a>
                    </div>
                </div>
            </div>
            @else
            @foreach($data as $item)
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapse{{$item->id}}">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            {{$loop->iteration.'. '}} {{$item['question']}} ?
                        </h4>
                    </div>
                </a>
                <div id="collapse{{$item->id}}" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        {{$item['answer']}} .
                        <br>
                        <br>

                        <div class="row">
                            <div class="col-1">
                            <a href="{{url('admin/settings/faq/'.$item['id'].'/edit')}}" class="btn btn-primary"> Edit </a>
                            </div>
                            <div class="col-1">
                            <form method="POST" action="{{url('admin/settings/faq/'.$item['id'])}}">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger"> Delete </button>
                            </form>
                            </div>
                            <div class="col-5">
                            </div>
                            <div class="col-5">
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            @endforeach
            <div class="text-center">
                <a href="{{url('admin/settings/faq/create')}}" class="btn btn-primary"> Add </a>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

