@extends('layouts.admin.admin')
@section('title','Edit FAQ')

@section('more-header')
<li class="breadcrumb-item"><a href="{{url('admin/settings/faq')}}">FAQ</a></li>
@endsection

@section('header','Edit question and answer')
@section('header-title','Edit question and its answer')

@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit the question and answer</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('admin/settings/faq/'.$data->id)}}">
                @csrf
                @method('PUT')
            <div class="row">
            <div class="col-md-12 mb-3">
                <label>Question</label>
                <div class="input-group">
                    <input type="text" name="question" value="{{$data->question}}" class="form-control">
                    <div class="input-group-append">
                      <span class="input-group-text">?</span>
                    </div>
                </div>
                @error('question')
                <span class="text-red" role="alert">
                  <strong> {{$message}} </strong>
                </span>
                @enderror
            </div>
    
            <div class="col-md-12 mb-3">
                <label>Answer</label>
                <textarea type="text" name="answer" rows="3" class="form-control">{{$data->answer}}</textarea>
            </div>
            @error('answer')
            <span class="text-red" role="alert">
              <strong> {{$message}} </strong>
            </span>
            @enderror
    
            </div>
    
            <div class="row">
                <div class="col-3"> 
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <div class="col-6"> 
                </div>
                <div class="col-3"> 
                    <a type="submit" href='{{url('admin/settings/faq')}}' class="btn btn-default float-right">Cancel</a>
                </div>
            </div>
          </form>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
  </div>
</div>
 
@endsection


