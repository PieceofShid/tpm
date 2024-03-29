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
  <!-- evo calendar -->
  <link rel="stylesheet" href="{{ asset('assets/evo-calendar/css/evo-calendar.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/evo-calendar/css/evo-calendar.orange-coral.min.css')}}">
  <!-- end evo -->
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        {{-- <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/logo.svg" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a> --}}
        <a href="{{ route('dashboard')}}" class="navbar-brand brand-logo mr-5">TPM Utility</a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard')}}">TPM</a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item d-none d-md-block h3 font-weight-light mt-2">
            UTILITY MAINTENANCE KANBAN CONTROL DASHBOARD
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item">
            <span class="d-none d-sm-block" id="clock"></span>
          </li>
          <li class="nav-item">
            <a href="{{ route('auth.logout')}}" class="nav-link">
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
          <li class="nav-item @if(Route::is('dashboard.index')) active @endif">
            <a class="nav-link" href="{{ route('dashboard')}}">
              <i class="ti-dashboard menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item @if(Route::is('kanban.monthly')) active @endif">
            <a class="nav-link" href="{{ route('kanban.monthly')}}">
              <i class="ti-calendar menu-icon"></i>
             <span class="menu-title">Monthly Kanban</span>
            </a>
          </li>
          @if (auth()->user()->level_id == 1 || auth()->user()->level_id == 2)
          <li class="nav-item @if(Route::is('schedule.index')||Route::is('schedule.add')||Route::is('schedule.edit')) active @endif">
            <a class="nav-link" href="{{ route('schedule.index')}}">
              <i class="ti-calendar menu-icon"></i>
              <span class="menu-title">Master Schedule</span>
            </a>
          </li>
          <li class="nav-item @if(Route::is('kanban.index')) active @endif">
            <a class="nav-link" href="{{ route('kanban.index')}}">
              <i class="ti-notepad menu-icon"></i>
              <span class="menu-title">Kanban Check</span>
            </a>
          </li>
          <li class="nav-item @if(Route::is('mesin.index')||Route::is('mesin.add')||Route::is('mesin.edit')) active @endif">
            <a class="nav-link" href="{{ route('mesin.index')}}">
              <i class="ti-settings menu-icon"></i>
              <span class="menu-title">Data Mesin</span>
            </a>
          </li>
          <li class="nav-item @if(Route::is('problem.index')||Route::is('problem.add')||Route::is('problem.edit')) active @endif">
            <a class="nav-link" href="{{ route('problem.index')}}">
              <i class="ti-bolt menu-icon"></i>
              <span class="menu-title">Temuan Problem</span>
            </a>
          </li>
          <li class="nav-item @if(Route::is('shift.index')||Route::is('shift.add')||Route::is('shift.edit')) active @endif">
            <a class="nav-link" href="{{ route('shift.index')}}">
              <i class="ti-exchange-vertical menu-icon"></i>
              <span class="menu-title">Data Shift</span>
            </a>
          </li>
          @endif
          @if (auth()->user()->level_id == 1)
          <li class="nav-item @if(Route::is('user.index')||Route::is('user.add')||Route::is('user.edit')) active @endif">
            <a class="nav-link" href="{{ route('user.index')}}">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">Data Pengguna</span>
            </a>
          </li>
          <li class="nav-item @if(Route::is('content.document')) active @endif">
            <a class="nav-link" href="{{ route('content.document')}}">
              <i class="ti-file menu-icon"></i>
              <span class="menu-title">Data Content</span>
            </a>
          </li>
          {{-- <li class="nav-item @if(Route::is('level.index')||Route::is('level.add')||Route::is('level.edit')) active @endif">
            <a class="nav-link" href="{{ route('level.index')}}">
              <i class="ti-star menu-icon"></i>
              <span class="menu-title">Data Level</span>
            </a>
          </li> --}}
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
        @if (!Route::is('kanban.monthly'))
        @php
          $running = App\Models\RunningText::where('code', 1)->get();
          foreach($running as $row){
            $data = $row->text;
          }

          count($running) > 0 ? $text = $data : $text = null;
        @endphp
        <div style="position: fixed; bottom:0; left:0;width:100%">
          <div class="px-2 bg-primary text-white"><marquee class="py-3">{{ucwords($text)}}</marquee></div>
        </div> 
        @endif
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
  <script src="{{ asset('assets/script/template.js')}}"></script>
  <!-- endinject -->

  <!-- moment js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>

  <!-- evo calendar -->
  <script src="{{ asset('assets/evo-calendar/js/evo-calendar.min.js')}}"></script>
  <!-- end evo -->

  @yield('script')

  <script>
    $(document).ready(function(){
      window.setInterval(function () {
          $('#clock').html(moment().format('dddd Do MMMM YYYY - HH:mm:ss'))
      }, 1000);
    });
  </script>
</body>

</html>

