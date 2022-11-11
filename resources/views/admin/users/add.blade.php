@extends('layouts.admin.admin')

@section('title','Add User')

@section('more-header')
<li class="breadcrumb-item"><a href="{{url('admin/users')}}">Users</a></li>
@endsection

@section('header-title','Register User')

@section('header','Add User')
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <div class="card card-primary">
                  <div class="card-header">
                      <h4 class="card-title"> Register a user </h4>
                  </div>
          
                  <div class="card-body">
                      <form action="{{url('admin/add-user')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="row">
                              <div class="col-md-6 mb-3">
                                  <label for="">Name</label>
                                  <div class="input-group mb-3">
                                      <input type="text" class="form-control" name="name" placeholder="Full Name">
                                      <div class="input-group-append">
                                        <div class="input-group-text">
                                          <span class="fas fa-user"></span>
                                        </div>
                                      </div>
                                </div>
                                @if($errors->has('name'))
                                <span class="text-red" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                              </div>

                              <div class="col-md-6 mb-3">
                                <label>Profile Image</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input">
                                    <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                                  </div>
                                </div>
                                @error('image')
                                <span class="text-red" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            
                              <div class="col-md-6 mb-3">
                                  <label> Email </label>
                                  <div class="input-group mb-3">
                                      <input type="email" class="form-control" name="email" placeholder="Email">
                                      <div class="input-group-append">
                                          <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                          </div>
                                        </div>
                                  </div>
                                  @error('email')
                                  <span class="text-red" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>

                              <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Role</label>
                                      <select class="form-control" name="role_as">
                                        <option value="0"> User </option>
                                        <option value="1"> Admin </option>
                                      </select>
                                  </div>
                                  @error('role_as')
                                  <span class="text-red" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>

                              <div class="col-md-6 mb-3">
                                <label for="">Mobile Phone</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="mobile" placeholder="Required">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <svg width="16" height="16" fill="black">
                                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                        </svg>
                                      </div>
                                    </div>
                                </div>
                                @if($errors->has('mobile'))
                                <span class="text-red" role="alert">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                                @endif
                              </div>

                              <div class="col-md-6 mb-3">
                                <label for="">Home Phone</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="phone" placeholder="Not Required">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <svg width="16" height="16" fill="black">
                                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                        </svg>
                                      </div>
                                    </div>
                                </div>
                                @if($errors->has('phone'))
                                    <span class="text-red" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                              </div>
          
                              <div class="col-md-12">
                                <label> Password </label>
                                <div class="input-group mb-3">
                                    <input  id="password" placeholder="Password" class="form-control" type="password" name="password" autocomplete="new-password">
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                    </div>
                                  </div>
                                </div>
                                @if($errors->has('password'))
                                <span class="text-red" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                              </div>

                              <div class="col-md-12">
                                <label>Confirm Password </label>
                                <div class="input-group mb-3">
                                  <input  id="password_confirmation" class="form-control" placeholder="Retype password" type="password" name="password_confirmation">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                      </div>
                                    </div>
                                  </div>
                                  @if($errors->has('password_confirmation'))
                                  <span class="text-red" role="alert">
                                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                                  </span>
                                  @endif
                              </div>
                           
                              <div class="col-md-12">
                                  <button type="submit" class="btn btn-primary"> Register </button>
                              </div>
          
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>

@endsection
