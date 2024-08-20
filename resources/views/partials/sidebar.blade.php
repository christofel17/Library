<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('lte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Perpustakaan</span>
  </a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      @can('user')
      <div class="image">
        <img src="{{ asset('lte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
      </div>
      @endcan
      @can('admin')
      <div class="info">
        <a href="#" class="d-block">Welcome Admin!</a>
      </div>
      @endcan
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
        <li class="nav-item">
          <a href="/test" class="nav-link">
            <i class="nav-icon fa fa-home"></i>
            <p>
              Menu Utama
              <!--<span class="badge badge-info right">2</span>-->
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/books" class="nav-link">
            <i class="nav-icon fa fa-book"></i>
            <p>
              Direktori Buku
              <!--<span class="badge badge-info right">2</span>-->
            </p>
          </a>
        </li>
        @can("admin")
        <li class="nav-item">
          <a href="/borrow" class="nav-link">
            <i class="nav-icon fa fa-calendar-alt"></i>
            <p>
              Data Peminjaman
              <!--<span class="badge badge-info right">2</span>-->
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/users" class="nav-link">
            <i class="nav-icon fa fa-address-book"></i>
            <p>
              Daftar User
              <!--<span class="badge badge-info right">2</span>-->
            </p>
          </a>
        </li>
        @endcan
        @can('user')
        <li class="nav-item">
          <a href="/borrow/self" class="nav-link">
            <i class="nav-icon fa fa-suitcase"></i>
            <p>
              Peminjaman Saya
              <!--<span class="badge badge-info right">2</span>-->
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/account" class="nav-link">
            <i class="nav-icon fa fa-cog"></i>
            <p>
              Pengaturan Akun
              <!--<span class="badge badge-info right">2</span>-->
            </p>
          </a>
        </li>
        @endcan
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  <!-- /.sidebar -->
</aside>