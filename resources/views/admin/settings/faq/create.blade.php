@extends('layouts.admin.admin')
@section('title','Add FAQ')

@section('more-header')
<li class="breadcrumb-item"><a href="{{url('admin/settings/faq')}}">FAQ</a></li>
@endsection

@section('header','Add question and answer')
@section('header-title','Add question and its answer')

@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add the question and answer</h3>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ url('admin/settings/faq')}}">
            @csrf
            <div class="row">
            <div class="col-md-12 mb-3">
                <label for="name">Question</label>
                <div class="input-group">
                    <input type="text" name="question" class="form-control">
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
                <label for="name">Answer</label>
                <textarea type="text" name="answer" rows="3" class="form-control"></textarea>
            </div>
            @error('answer')
            <span class="text-red" role="alert">
              <strong> {{$message}} </strong>
            </span>
            @enderror
    
            </div>
    
            <div class="row">
                <div class="col-3"> 
                    <button type="submit" class="btn btn-primary">Add</button>
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


