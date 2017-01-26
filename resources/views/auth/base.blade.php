@include('auth.header')

<body class="hold-transition login-page skin-ufop" style="-moz-user-select: text;">
   @yield('content')
</body>

@include('auth.footer')

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.1.3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="{{asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!-- CPF Mask Js -->
<script src="{{asset('js/cpfMask.js') }}"></script>

<script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>

<script src="../../plugins/iCheck/icheck.min.js"></script>

@yield('myScripts')

</body>
</html>
