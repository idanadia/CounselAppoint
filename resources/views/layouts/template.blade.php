<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>
  <link href="{{ asset('sass/app.scss') }}" rel="stylesheet">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

  <style>
    .main-sidebar {
      background-color: #5c001f !important;
    }

    .nav-link.active {
      background-color: #343a40 !important;
    }

    li.nav-item ul.nav-treeview li.nav-item .active {
      /* CSS properties for children elements */
      background-color: grey !important;
      color: white !important;

    }

    /* .sidebar .nav-link:not(.active):hover {
      background-color: #343a4049 !important;

    }

    .sidebar a:hover {
      background-color: red !important;
    } */


    .brand-link,
    .user-panel {
      border-bottom: 1px solid #343a40 !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60"
        width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        {{-- <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> --}}
      </ul>

      <!-- Right navbar links -->

      <!-- Navbar Search -->


      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->


      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" href="{{ route('chats.index') }}" role="button">
            <i class="fa fa-comments"></i>
            @if ( Auth::user()->unseenMessagesCount() != 0 )
            <span class="badge badge-danger navbar-badge">{{Auth::user()->unseenMessagesCount()}}</span>

            @endif
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- Message items here -->
          </div>
        </li>

        <!-- Notifications Dropdown Menu -->
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-maroon elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('home.'.Auth::user()->role) }}" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">CounselAppointment</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img
              src="{{! Auth::user()->imagePath ? asset('admin/dist/img/default.jpg'):Storage::url('images/' .  Auth::user()->imagePath) }}"
              class="img-circle elevation-2" alt="aff" style="object-fit: cover; width: 40px; height:40px;">
          </div>

          <div class="info">
            <a href="{{ route('users.edit', ['user' => Auth::user()->id]) }}" class="d-block">
              {{Auth::user()->fullName }} <br>
              {{ Auth::user()->email}} <br>
              @if(Auth::user()->role == 'supervisor')
              <i class="fa fa-user-secret"></i>
              @elseif(Auth::user()->role == 'counselor')
              <i class="fa fa-user-tie"></i>
              @else
              <i class="fas fa-user-graduate"></i>
              @endif
              {{ ucfirst(Auth::user()->role)}}
            </a>
          </div>

        </div>

        <!-- SidebarSearch Form -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if(Auth::user()->role=='client')
            <li class="nav-item {{ Request::is('home*') ? 'menu-open' : '' }}">
              <a href="{{ route('home.'.Auth::user()->role) }}"
                class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
                @else
            <li class="nav-item {{ Request::is(Auth::user()->role.'/home*') ? 'menu-open' : '' }}">
              <a href="{{ route('home.'.Auth::user()->role) }}"
                class="nav-link {{ Request::is(Auth::user()->role.'/home*') ? 'active' : '' }}">
                @endif

                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is(Auth::user()->role.'/appointments*') ? 'menu-open' : '' }}">
              <a href="{{ route(Auth::user()->role.'.appointments.index') }}"
                class="nav-link {{ Request::is(Auth::user()->role.'/appointments*') ? 'active' : '' }}">
                <i class="nav-icon far fa-calendar-check"></i>
                <p>
                  Appointments
                </p>
              </a>
            </li>
            @if(Auth::user()->role =="client")
            <li class="nav-item {{ Request::is('client/counselors*') ? 'menu-open' : '' }}">
              <a href="{{ route('client.counselors.index') }}"
                class="nav-link {{ Request::is('client/counselors*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-user-tie"></i>
                <p>
                  Counselors
                </p>
              </a>
            </li>
            @endif
            {{-- --}}
            {{-- --}}
            @if(Auth::user()->role =="supervisor")
            <li
              class="nav-item {{ Request::is('supervisor/counselors*') || Request::is('supervisor/clients*') ? 'menu-open' : '' }}">
              <a href="#"
                class="nav-link {{ Request::is('supervisor/counselors*') || Request::is('supervisor/clients*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Users
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('supervisor.counselors.index') }}"
                    class="nav-link {{ Request::is('supervisor/counselors*') ? 'active' : '' }}">
                    <i class="fa fa-user-tie nav-icon"></i>
                    <p>List of Counselors</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('supervisor.clients.index') }}"
                    class="nav-link {{ Request::is('supervisor/clients*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate nav-icon"></i>
                    <p>List of Clients</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
            {{-- --}}
            {{-- --}}
            @if(Auth::user()->role =="counselor")
            <li class="nav-item {{ Request::is(Auth::user()->role.'/timeslots*') ? 'menu-open' : '' }}">
              <a href="{{ route(Auth::user()->role.'.timeslots.index') }}"
                class="nav-link {{ Request::is(Auth::user()->role.'/timeslots*') ? 'active' : '' }}">
                <i class="nav-icon far fa-hourglass"></i>
                <p>
                  Timeslots
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is(Auth::user()->role.'/clients*') ? 'menu-open' : '' }}">
              <a href="{{ route(Auth::user()->role.'.clients.index') }}"
                class="nav-link {{ Request::is(Auth::user()->role.'/clients*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Clients
                </p>
              </a>
            </li>
            @endif


            {{-- <li class="nav-item {{ Request::is('users*') || Request::is('inspections*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('users*') || Request::is('inspections*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Forms
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('supervisor.counselors.index') }}"
                    class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>List of Users</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('inspections.index') }}"
                    class="nav-link {{ Request::is('inspections*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>List of Inspections</p>
                  </a>
                </li>
              </ul>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>{{ __('Logout') }}</p>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </nav>

        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              {{-- <h1 class="m-0">Dashboard</h1> --}}
            </div><!-- /.col -->
            <div class="container">
              @yield('content')
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0-rc
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>

  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
</body>

</html>