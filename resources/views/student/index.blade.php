@extends('layout.student.base')

@section('title')
   Gerenciar | Alunos
@endsection

@section('content-header')
   <h1>Gerenciar Alunos</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="container">
      <div class="panel panel-default">
         <div class="panel-heading">
            <p class="panel-title">Alunos</p>
         </div>
         <div class="panel-body">
            @include('student.students_list')
         </div>
      </div>
   </div>

@endsection
