@extends('templates.pagesTemplate')

@section('navigationBar')
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
           <!-- Brand and toggle get grouped for better mobile display -->
           <div class="navbar-header">
               <a class="navbar-brand" href="{{url('index')}}">SystemName</a>
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
                       <a>{{date('d/M')}}</a>
                   </li>
               </ul>
           </div>
      </div>
   </nav>
@endsection

@section('content')
   <div class="col-lg-12">
      <img class="img-responsive col-lg-6" src="{{asset('images/logoNTI.jpeg')}}" alt="Logo NTI">
      <form class="form-horizontal col-lg-6" method="POST" action="{{--url('login_check')--}}">
           <fildset>
               <legend>Login no Sistema</legend>
               <div class="col-lg-9">
                   <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input class="form-control input-xlarge" type="text" id="username" placeholder="CPF" autofocus>
                   </div>
                   <br/>
               </div>
               <div class="col-lg-9">
                   <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                       <input class="form-control input-xlarge " type="password" id="password" placeholder="Senha">
                   </div>
               </div>
               <div class="col-lg-9">
                   {{-- {% if error %}

                   {% endif %} --}}
                   <p class ="help-block">{{--erro--}}</p>
               </div>
               <div class="col-lg-9">
                   <br/>
                   <button type="submit" class="btn btn-primary">Entrar</button>
                   <button type="reset" class="btn btn-default">Limpar</button>
               </div>
           </fildset>
      </form>

   </div>
@endsection
