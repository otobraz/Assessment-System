<!DOCTYPE html>
<html lang="br">

<head>

   @section('header')
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <title>Sistema de Avaliação</title>
      <meta name="generator" content="Bootply" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
      <link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css">
   @show

</head>

<body>

   <div class="navbar">
      @section('navigationBar')
         <!-- Barra de Navegação -->
         <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
               <!-- Brand and toggle get grouped for better mobile display -->
               <div class="navbar-header">
                  <a class="navbar-brand"  href="{{ url('/') }}">SystemName</a>
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                  </button>
               </div>

               <!-- Collect the nav links, forms, and other content for toggling -->
               <div class="navbar-inverse collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                     <li><a href="{{url('sobre')}}">Informações</a></li>
                     <li><a href="{{url('contato')}}">Contato</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                     <li>
                        @if(session('username')) <!-- Se houver usuário logado -->
                           <a href="{{url('perfil')}}">{{session('first_name') . " " . session('last_name')}}</a>
                        @endif
                     </li>
                     <li>
                        <a>{{date('d/M')}}</a>
                     </li>
                     <li>
                        @if(session('username')) <!-- Se houver usuário logado -->
                           <a href="{{url('logout')}}"><span class="glyphicon glyphicon-off"></span> Sair</a>
                        @endif
                     </li>
                  </ul>
               </div>
            </div>
         </nav><!-- /.navbar-collapse -->
      @show

   </div> <!-- navbar -->

   <div class="container">

      @yield('menu')
      {{-- @section('menu')
      <div class="col-md-3">
      <p class="lead">HelpDesk</p>
      <div class="list-group">
      <a href="{{url('home')}}" class="list-group-item">Início</a>
      <a href="{{url('chamados_novo')}}" class="list-group-item">Abrir Chamado</a>
      <a href="{{url('chamados')}}" class="list-group-item">Meus Chamados</a>
      <a href="{{url('chamados_fila')}}" class="list-group-item">Fila de Espera</a>
      <a href="{{url('perfil')}}" class="list-group-item">Perfil de Usuário</a>
   </div>
</div>
@show --}}
   @if(session('message'))
      {{ session('message') }}
   @endif

   @yield('content')

   </div>

   <div class="container">
      <hr>
      @section('footer')
         <!-- Footer -->
         <footer>
            <div class="row">
               <div class="col-lg-12">

                  <p>ICEA &copy; Nome do Sistema 2016</p>
                  <p>Oto Braz Assunção</p>
               </div>
            </div>
         </footer>
      @show

   </div>

   @section('scripts')

      <!-- script references -->
      <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
      <script src="{{asset('js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>

   @endsection

</body>

</html>
