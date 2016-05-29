@extends('templates.pagesTemplate')

@section('navigationBar')
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
         <!-- Brand and toggle get grouped for better mobile display -->
         <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/')}}">SystemName</a>
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
               <li><a href="{{url('ldap')}}">Testar Ldap</a></li>
               <li><a href="{{url('login')}}">Login</a></li>



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
   <h1>HOME PAGE</h1>
@endsection
