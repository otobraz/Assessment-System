@extends('layout.admin.base')

@section('title')
   Gerenciar | Alunos
@endsection

@section('content-header')
   <h1>Gerenciar Alunos</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="container-fluid">
      <div class="panel panel-default">
         <div class="panel-heading contains-buttons">
            <a class="btn btn-primary pull-right" role="button"
            style="color: white" href="{{route('student.import')}}">Importar Alunos</a>
            <p class="panel-title contains-buttons pull-left">Alunos</p>
            <span class="clearfix"></span>
         </div>
         <div class="panel-body">
            @include('alert-message.success')
            @include('alert-message.error')
            @include('student.admin.students-list')
         </div>
      </div>
   </div>

@endsection
