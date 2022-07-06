<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TPM Utility - @yield('title')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/feather/feather.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('assets/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/select.dataTables.min.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        {{-- <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/logo.svg" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a> --}}
        <a href="#" class="navbar-brand brand-logo mr-5">TPM Utility</a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item">
            <a href="{{ route('auth.logout')}}" class="nav-link">
              <i class="ti-power-off text-primary"></i>
              Logout
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          @if (auth()->user()->level_id == 1)
          <li class="nav-item @if(Route::is('schedule.index')||Route::is('schedule.add')||Route::is('schedule.edit')) active @endif">
            <a class="nav-link" href="{{ route('schedule.index')}}">
              <span class="menu-title">Master Schedule</span>
            </a>
          </li>
          <li class="nav-item @if(Route::is('mesin.index')||Route::is('mesin.add')||Route::is('mesin.edit')) active @endif">
            <a class="nav-link" href="{{ route('mesin.index')}}">
              <span class="menu-title">Data Mesin</span>
            </a>
          </li>
          <li class="nav-item @if(Route::is('shift.index')||Route::is('shift.add')||Route::is('shift.edit')) active @endif">
            <a class="nav-link" href="{{ route('shift.index')}}">
              <span class="menu-title">Data Shift</span>
            </a>
          </li>
          <li class="nav-item @if(Route::is('user.index')||Route::is('user.add')||Route::is('user.edit')) active @endif">
            <a class="nav-link" href="{{ route('user.index')}}">
              <span class="menu-title">Data Pengguna</span>
            </a>
          </li>
          <li class="nav-item @if(Route::is('level.index')||Route::is('level.add')||Route::is('level.edit')) active @endif">
            <a class="nav-link" href="{{ route('level.index')}}">
              <span class="menu-title">Data Level</span>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
                @yield('content')
            </div>
          </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('assets/script/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('assets/script/jquery.dataTables.js')}}"></script>
  <script src="{{ asset('assets/script/dataTables.bootstrap4.js')}}"></script>
  <script src="{{ asset('assets/script/dataTables.select.min.js')}}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets/script/off-canvas.js')}}"></script>
  <script src="{{ asset('assets/script/hoverable-collapse.js')}}"></script>
  {{-- <script src="{{ asset('assets/script/template.js')}}"></script> --}}
  <!-- endinject -->

  @yield('script')
</body>

</html>

