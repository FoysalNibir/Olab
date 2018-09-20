<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Olab</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/skin-blue.min.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style type="text/css">
  .box {
    border-top: 0px solid #d2d6de;
}
</style>

@yield('extralink')
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>o</b>lab</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>O</b>lab</span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">

        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
        </div>

        <!-- search form (Optional) -->

        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">

          <!-- Optionally, you can add icons to the links -->
          <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{route('dashboard')}}">
              <i class="fa fa-user text-orange"></i> <span>Profile</span>
            </a>
          </li>
          
          @if(Auth::user()->hastype('client'))
          <li class="treeview {{ Request::is('client*') ? 'active menu-open' : '' }}">
            <a href="#"><i class="fa fa-dashboard text-blue"></i> <span>User Panel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('client/order/create') ? 'active' : '' }}"><a href="{{route('client.order.create')}}"><i class="fa fa-random text-purple"></i>New Test</a></li>
              <li class="{{ Request::is('client/orders') ? 'active' : '' }}"><a href="{{route('client.orders')}}"><i class="fa fa-th-list text-red"></i>Orders</a></li>
              <li class="{{ Request::is('client/orders') ? 'active' : '' }}"><a href="{{route('client.addpromo')}}"><i class="fa fa-money text-green"></i>Add Promo</a></li>
            </ul>
          </li>
          @endif

          @if(Auth::user()->hastype('operation'))
          <li class="treeview {{ Request::is('operation*') ? 'active menu-open' : '' }} ">
            <a href="#"><i class="fa  fa-cogs text-orange"></i><span>Operation Panel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('operation/today') ? 'active' : '' }}"><a href="{{route('operation.today')}}"><i class="fa fa-clock-o text-purple"></i>Today</a></li>
              <li class="{{ Request::is('operation/pending') ? 'active' : '' }}"><a href="{{route('operation.pending')}}"><i class="fa fa-hourglass-half text-yellow"></i>Pending</a></li>
              <li class="{{ Request::is('operation/field') ? 'active' : '' }}"><a href="{{route('operation.field')}}"><i class="fa fa-map text-green"></i>Field</a></li>
            </ul>
          </li>
          @endif

          @if(Auth::user()->hastype('field'))
          <li class="treeview {{ Request::is('field*') ? 'active menu-open' : '' }}">
            <a href="#"><i class="fa  fa-ambulance text-red"></i><span>Field Panel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('field/today') ? 'active' : '' }}"><a href="{{route('field.today')}}"><i class="fa fa-clock-o text-purple"></i>Today</a></li>
              <li class="{{ Request::is('field/pending') ? 'active' : '' }}"><a href="{{route('field.pending')}}"><i class="fa fa-hourglass-half text-yellow"></i>Pending</a></li>
              <li class="{{ Request::is('field/collected') ? 'active' : '' }}"><a href="{{route('field.collected')}}"><i class="fa fa-thumbs-up text-green"></i>Collected</a></li>
              <li class="{{ Request::is('field/inlab') ? 'active' : '' }}"><a href="{{route('field.inlab')}}"><i class="fa fa-eyedropper text-orange"></i>In Lab</a></li>
            </ul>
          </li>
          @endif


          @if(Auth::user()->hastype('report'))
          <li class="treeview {{ Request::is('report*') ? 'active menu-open' : '' }}">
            <a href="#"><i class="fa fa-file-word-o text-aqua"></i> <span>Report Panel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('report/today') ? 'active' : '' }}"><a href="{{route('report.today')}}"><i class="fa fa-clock-o text-purple"></i>Today</a></li>
              <li class="{{ Request::is('report/pending') ? 'active' : '' }}"><a href="{{route('report.pending')}}"><i class="fa fa-hourglass-half text-yellow"></i>Pending</a></li>
              <li class="{{ Request::is('report/deliverred') ? 'active' : '' }}"><a href="{{route('report.deliverred')}}"><i class="fa  fa-ship text-green"></i>Deliverred</a></li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->hastype('admin'))
          <li class="treeview {{ Request::is('admin*') ? 'active menu-open' : '' }}">
            <a href="#"><i class="fa fa-cog text-green"></i> <span>Admin Panel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a href="{{route('admin.dashboard')}}"><i class="fa fa-cubes text-red"></i>Dashboard</a></li>
              <li class="{{ Request::is('admin/users') ? 'active' : '' }}"><a href="{{route('admin.users')}}"><i class="fa fa-users text-yellow"></i>Users</a></li>
              <li class="{{ Request::is('admin/createuser') ? 'active' : '' }}"><a href="{{route('admin.createuser')}}"><i class="fa  fa-user-plus text-red"></i>Create User</a></li>
              <li class="{{ Request::is('admin/orders') ? 'active' : '' }}"><a href="{{route('admin.orders')}}"><i class="fa fa-hourglass text-aqua"></i>Orders</a></li>
              <li class="{{ Request::is('admin/signuprequests') ? 'active' : '' }}"><a href="{{route('admin.signuprequests')}}"><i class="fa fa-user-plus text-maroon"></i>Sign Up Requests</a></li>
              <li class="{{ Request::is('admin/test') ? 'active' : '' }}"><a href="{{route('admin.test')}}"><i class="fa fa-eye text-orange"></i>Tests</a></li>
              <li class="{{ Request::is('admin/category') ? 'active' : '' }}"><a href="{{route('admin.category')}}"><i class="fa fa-th-large text-maroon"></i>Category</a></li>
              <li class="{{ Request::is('admin/coupon') ? 'active' : '' }}"><a href="{{route('admin.coupon')}}"><i class="fa fa-tag text-green"></i>Coupon</a></li>
            </ul>
          </li>
          @endif

          @if(Auth::user())

          <li class="header">OTHERS</li>
          <li class="{{ Request::is('changepassword') ? 'active' : '' }}">
            <a href="{{route('changepassword')}}">
              <i class="fa fa-lock text-green"></i> <span>Change Password</span>
            </a>
          </li>

          <li>
            <a href="{{route('logout')}}">
              <i class="fa  fa-user-secret text-red"></i> <span>Logout</span>
            </a>
          </li>

          @endif
          

        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    @yield('content')




    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->



  <!-- jQuery 3 -->
  <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
     @yield('extrascript')

   </body>
   </html>