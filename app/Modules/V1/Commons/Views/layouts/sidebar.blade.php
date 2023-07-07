<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Multi-Tenant</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('/').Storage::url(\Auth::user()->image_path)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <a href="{{route('edit.profile.view',['role' => \Auth::user()->role->slug])}}">
          <div class="info">
            {{ (Auth::user()->first_name) }} {{ \Auth::user()->last_name }}
          </div>
        </a>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               {{-- @json($sidebar); --}}
          @foreach ($sidebar as $item)
            @if ($item->permission->slug == 'view')  
              <li class="nav-item">
                <a href="{{URL::to(\Auth::user()->role->slug.$item->menu->link)}}" class="nav-link {{ Request::is(\Auth::user()->role->slug.$item->menu->link) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    @if ($item->menu->slug == 'settings')
                      {{ $item->menu->title}}
                      <i class="right fas fa-angle-left"></i>  
                    @else
                      {{ $item->menu->title}}  
                    @endif
                  </p>
                </a>
                @if ($item->menu->slug == 'settings')  
                  @include('Settings::partials.setting_sidebar_items')
                @endif
              </li>
            @endif
          @endforeach
          <li class="nav-item">
            <a href="{{route('user.logout',['role' => \Auth::user()->role->slug])}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                  Logout
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>