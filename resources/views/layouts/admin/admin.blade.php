<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @include('layouts.admin.head.links')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    
      @include('layouts.admin.header.nav')

      @include('layouts.admin.header.placeholder')

      @include('layouts.admin.header.sidebar')
    
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">@yield('header-title')</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  @yield('more-header')
                  <li class="breadcrumb-item active">@yield('header')</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
    
        @yield('content')
          

      </div>
    
    @include('layouts.admin.footer.links')
    </body>
</html>
