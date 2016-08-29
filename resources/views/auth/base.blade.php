@include('auth.header')

@yield('content')

@include('auth.footer')

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.1.3 -->
<script src="{{asset('jQuery/js/jQuery.min.js') }}"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="{{asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
</body>
</html>
