@extends('layout.admin.base')

@section('title')
   Gerenciar | Departamentos
@endsection

@section('content-header')
   <h1>Gerenciar Departamentos</h1>
   <hr>
@endsection

@section('content')

   <div class="container">
      <div class="panel panel-default">
         <div class="panel-heading contains-buttons">
            <a class="btn btn-primary pull-right" role="button"
            style="color: white" href="{{route('department.create')}}">Novo Departamento</a>
            <p class="panel-title contains-buttons pull-left">DEPARTAMENTOS</p>
            <span class="clearfix"></span>
         </div>
         <div class="panel-body">
            @include('alert-message.success')
            @include('alert-message.error')
            @include('department.departments-list')
         </div>
      </div>
   </div>

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
