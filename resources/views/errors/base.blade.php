<!DOCTYPE html>

<html lang="pt">

<head>

   <meta charset="UTF-8">

   <title>SisAV - @yield('title')</title>

   <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
   <!-- Font Awesome Icons -->
   <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
   <!-- Ionicons -->
   <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
   <!-- Theme style -->
   <link href="{{ asset('dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />

   <link href="{{asset('dist/css/skins/skin-ufop.css')}}" rel="stylesheet" type="text/css" />

</head>

<body class="hold-transition skin-ufop sidebar-mini">

   @yield('content')

   <!-- jQuery 2.1.3 -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

   <!-- Bootstrap 3.3.2 JS -->
   <script src="{{asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

   <!-- AdminLTE JS -->
   <script src="{{asset('dist/js/app.min.js')}}"></script>

</body>

</html>
