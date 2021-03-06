<!DOCTYPE html>
<html>

<head>

   <meta charset="UTF-8">

   <title>@yield('title')</title>

   <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
   <!-- Bootstrap 3.3.2 -->
   <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
   <!-- Font Awesome Icons -->
   <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
   <!-- Ionicons -->
   <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
   <!-- Theme style -->
   <link href="{{ asset('dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />

   <link href="{{asset('dist/css/skins/skin-ufop.css')}}" rel="stylesheet" type="text/css" />

   <link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css" />

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
   <![endif]-->
</head>

<body class="hold-transition skin-ufop sidebar-mini">
   <div class="wrapper">

      <!-- Header -->
      @yield('header')

      <!-- Sidebar -->
      @yield('sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">

            @yield('content-header')

            <!-- You can dynamically generate breadcrumbs here -->

            <!--
            <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
            </ol>
            -->
         </section>

         <!-- Main content -->
         <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
         </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Footer -->
      @include('dashboard.footer')

   </div><!-- ./wrapper -->

   <!-- REQUIRED JS SCRIPTS -->

   <!-- jQuery 2.1.3 -->
   <script src="{{asset('plugins/jQuery/jQuery-2.2.3.min.js')}}"></script>

   <!-- Bootstrap 3.3.2 JS -->
   <script src="{{asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

   <!-- AdminLTE JS -->
   <script src="{{asset('dist/js/app.min.js')}}"></script>

   @yield('myScripts')

</body>

</html>
