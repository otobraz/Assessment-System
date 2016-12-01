@extends('layout.admin.base')

@section('title')
   Gerenciar | Cursos
@endsection

@section('content-header')
   <h1>Gerenciar Cursos</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="panel panel-default">
      <div class="panel-heading contains-buttons">
         <a class="btn btn-primary pull-right" role="button"
         style="color: white" href="{{route('major.create')}}">Novo Curso</a>
         <p class="panel-title contains-buttons pull-left">CURSOS</p>
         <span class="clearfix"></span>
      </div>
      <div class="panel-body">
         @include('alert-message.success')
         @include('alert-message.error')
         @include('major.majors-list')
      </div>
   </div>

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
