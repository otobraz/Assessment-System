<!DOCTYPE html>

<html>

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

          <!-- Navigation Bar -->
          @section('navBar')
             <div class="navbar">
                   <!-- Barra de Navegação -->
                   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                        <div class="container">
                             <!-- Brand and toggle get grouped for better mobile display -->
                             <div class="navbar-header">
                                 {{-- <a class="navbar-brand" href="{{path('login')}}">SisNti</a> --}}
                                 <a class="navbar-brand"  href="{{ url('oparea') }}">Sistema de Avaliação</a>
                                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                 </button>
                             </div>

                             <!-- Collect the nav links, forms, and other content for toggling -->
                             <div class="navbar-inverse collapse navbar-collapse">
                                 <ul class="nav navbar-nav">
                                    {{-- <li><a href="{{path('informacoes')}}">Informações</a></li>
                                    <li><a href="{{path('contato')}}">Contato</a></li> --}}
                                    <li><a href="{{ url('oparea') }}">Pesquisa de Disciplina</a></li>
                                    <li><a href="{{ url('oparea') }}">Pesquisa de TCC</a></li>
                                    <li><a href="{{ url('oparea') }}">Forum</a></li>
                                 </ul>
                                 <ul class="nav navbar-nav navbar-right">
                                    <li>
                                       <a href="{{url('perfil')}}">{{"Nome do Usuário"}}</a>
                                    </li>
                                    <li>
                                       <a>{{date('d/M')}}</a>
                                    </li>
                                    <li>
                                       <a href="{{url('logout')}}"><span class="glyphicon glyphicon-off"></span> Sair</a>
                                    </li>
                                 </ul>
                             </div>
                        </div>
                   </nav><!-- /.navbar-collapse -->
             </div>
         @show

          <!-- Content -->
          @yield('content')


          <!-- Footer -->
          @section('footer')
             <div class="container">

                <hr>
                <!-- Footer -->
                <footer>
                     <div class="row">
                         <div class="col-lg-12">
                             <p>ICEA &copy; SisNTI 2015</p>
                             <p>Oto Braz Assunção</p>
                         </div>
                     </div>
                </footer>

             </div>
          @show
   </body>
</html>
