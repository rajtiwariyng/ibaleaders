  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ asset('admin-assets/dist/img/white-logo.png') }}" alt="ibaleaders Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">IBA Leaders</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin-assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            @if (Auth::guard('admin')->check())
                {{ Auth::guard('admin')->user()->name }}
            @else
                Guest
            @endif
          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('admin/blog*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Manage Blog</p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ Request::is('admin/permissions/index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Manage Permissions</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles/index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Manage Roles</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.frontedUsers.list') }}" class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Front User List</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.adminUsers.list') }}" class="nav-link {{ Request::is('admin/adminusers') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Admin User List</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.adminUsers.create') }}" class="nav-link {{ Request::is('admin/adminusers/create') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Create Admin Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.frontedUsers.create') }}" class="nav-link {{ Request::is('admin/frontedUsers/create') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Create Front Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.events.index') }}" class="nav-link {{ Request::is('admin/events') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Events List</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.events.create') }}" class="nav-link {{ Request::is('admin/events/create') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Create Event</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.visitors.list') }}" class="nav-link {{ Request::is('admin/visitors/list') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>visitors List</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.blogs.create') }}" class="nav-link {{ Request::is('admin/blogs/create') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Create Blog</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ Request::is('admin/blogs/index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Blog list</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.categories.create') }}" class="nav-link {{ Request::is('admin/categories/create') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Create Categories</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ Request::is('admin/categories/index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Categories list</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.report.import') }}" class="nav-link {{ Request::is('admin/report/import') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Import Report</p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       @include('admin.layouts.message')
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>page heading</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li> -->
            </ol>
          </div>
        </div>
      </div>
    </section>