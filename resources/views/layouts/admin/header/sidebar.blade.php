<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <div class="brand-link">
    <img 
    @if($logo->count() <1)
    src="{{asset('logo/logo.png')}}"
    @else
    src="{{asset('uploads/ecommerce/Logo/'.$logo['logo'])}}"
    @endif
     alt="Ecommerce Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">
      {{$datas['name']}}
    </span>
  </div>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @if(isset(Auth::user()->image))
        <img src="{{asset('uploads/admin/users/'.Auth::user()->image)}}" class="img-circle elevation-2" alt="User Image">
        @else
        <img src="{{asset('admin/dist')}}/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        @endif
      </div>
      <div class="info">
        <a href="" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      
        <li class="nav-item {{ Request::is('admin/dashboard','admin/users/myInfo') ? 'menu-open':'' }}">
          <a href="#" class="nav-link {{ Request::is('admin/dashboard','admin/users/myInfo') ? 'active':'' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('admin/dashboard')}}" class="nav-link {{ Request::is('admin/dashboard') ? 'active':'' }}">
              <img src="{{asset('icons/home.png')}}" class="nav-icon">
                <p>Home</p>
              </a>
              <a href="{{url('admin/users/myInfo')}}" class="nav-link {{ Request::is('admin/users/myInfo') ? 'active':'' }}">
                <img src="{{asset('icons/personalInfo.png')}}" class="nav-icon">
                <p>Your Information</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item {{ Request::is('admin/settings/logo','admin/settings/info') ? 'menu-open':'' }}">
          <a href="#" class="nav-link {{ Request::is('admin/settings/logo','admin/settings/info') ? 'active':'' }}">
            <svg width="25" class="nav-icon" height="25" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.405 3.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 01-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 01.872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 012.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 012.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 01.872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 01-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 01-2.105-.872l-.1-.34zM10 12.93a2.929 2.929 0 100-5.858 2.929 2.929 0 000 5.858z" clip-rule="evenodd"/>
            </svg>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('admin/settings/info')}}" class="nav-link {{ Request::is('admin/settings/info') ? 'active':'' }}">
                <img src="{{asset('icons/info.png')}}" class="nav-icon"/>
                <p>Informations</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('admin/settings/logo')}}" class="nav-link {{ Request::is('admin/settings/logo') ? 'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Logo</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item {{ Request::is('admin/settings/faq','admin/settings/faq/create') ? 'menu-open':'' }}">
          <a href="#" class="nav-link {{ Request::is('admin/settings/faq','admin/settings/faq/create') ? 'active':'' }}">
            <img src="{{asset('icons/ask.png')}}" class="nav-icon">
            <p>
              FAQ
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('admin/settings/faq')}}" class="nav-link {{ Request::is('admin/settings/faq') ? 'active':'' }}">
                <img src="{{asset('icons/view.png')}}" class="nav-icon">
                <p>View FAQ</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('admin/settings/faq/create')}}" class="nav-link {{ Request::is('admin/settings/faq/create') ? 'active':'' }}">
                <i class="fas fa-plus-circle" class="nav-icon" ></i>
                <p>Add FAQ</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item {{ Request::is('admin/categories','admin/categories/create') ? 'menu-open':'' }}">
          <a href="#" class="nav-link {{ Request::is('admin/categories','admin/categories/create') ? 'active':'' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Categories
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('admin/categories')}}" class="nav-link {{ Request::is('admin/categories') ? 'active':'' }}">
                <img src="{{asset('icons/view.png')}}" class="nav-icon">
                <p>View Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('admin/categories/create')}}" class="nav-link {{ Request::is('admin/categories/create') ? 'active':'' }}">
                <i class="fas fa-plus-circle" class="nav-icon" ></i>
                <p>Add Categories</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item {{ Request::is('admin/products','admin/products/create') ? 'menu-open':'' }}">
          <a href="#" class="nav-link {{ Request::is('admin/products','admin/products/create') ? 'active':'' }}">
            <img src="{{asset('icons/market.png')}}" class="nav-icon">
            <p>
              Products
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('admin/products')}}" class="nav-link {{ Request::is('admin/products') ? 'active':'' }}">
                <img src="{{asset('icons/view.png')}}" class="nav-icon">
                <p>View Products</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('admin/products/create')}}" class="nav-link {{Request::is('admin/products/create') ? 'active':'' }}">
                <i class="fas fa-plus-circle" class="nav-icon" ></i>
                <p>Add Products</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item {{ Request::is('admin/orders') ? 'menu-open':'' }}">
          <a href="#" class="nav-link {{ Request::is('admin/orders') ? 'active':'' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Orders
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('admin/orders')}}" class="nav-link {{ Request::is('admin/orders') ? 'active':'' }}">
                <img src="{{asset('icons/view.png')}}" class="nav-icon">
                <p>View Orders</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item {{Request::is('admin/admins','admin/users','admin/add-user') ? 'menu-open':'' }}">
          <a href="#" class="nav-link {{Request::is('admin/admins','admin/users','admin/add-user') ? 'active':'' }}">
            <i class="fas fa-users"></i>
            <p>
              Admins and Users
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('admin/admins')}}" class="nav-link  {{Request::is('admin/admins') ? 'active':''}}">
                <i class="fas fa-users nav-icon"></i>
                <p>View Admins</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('admin/users')}}" class="nav-link {{Request::is('admin/users') ? 'active':''}}">
                <i class="fas fa-users nav-icon"></i>
                <p>View Registered Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('admin/add-user')}}" class="nav-link {{Request::is('admin/add-user') ? 'active':''}}">
                <i class="fas fa-plus-circle" class="nav-icon" ></i>
                <p>Add User</p>
              </a>
            </li>
          </ul>
        </li>

        {{-- <li class="nav-item {{Request::is('admin/pages','admin/pages/create') ? 'menu-open':'' }}">
          <a href="#" class="nav-link {{Request::is('admin/pages','admin/pages/create') ? 'active':'' }}">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Pages
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('admin/pages')}}" class="nav-link {{ Request::is('admin/pages') ? 'active':'' }}">
                <img src="{{asset('icons/view.png')}}" class="nav-icon">
                <p>View Pages</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('admin/pages/create')}}" class="nav-link {{ Request::is('admin/pages/create') ? 'active':'' }}">
                <i class="fas fa-plus-circle" class="nav-icon" ></i>
                <p>Add Page</p>
              </a>
            </li> --}}
          </ul>
        </li>
  
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
