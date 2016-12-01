@extends('layout.admin.base')

@section('title')
   Gerenciar | Administradores
@endsection

@section('content-header')
   <h1>
      Gerenciar Administradores
   </h1>
   <hr>
@endsection

@section('content')

   <div class="panel panel-default">
      <div class="panel-heading contains-buttons">
         <a class="btn btn-primary pull-right" role="button"
         style="color: white" href="{{route('admin.create')}}">Novo Administrador</a>
         <p class="panel-title contains-buttons pull-left">Administradores</p>
         <span class="clearfix"></span>
      </div>
      <div class="panel-body">
         @include('alert-message.success')
         @include('alert-message.error')
         @include('admin.admins-list')
      </div>
   </div>

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
