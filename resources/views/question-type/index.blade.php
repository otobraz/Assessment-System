@extends('layout.admin.base')

@section('title')
   Gerenciar | Tipos de Pergunta
@endsection

@section('content-header')
   <h1>Tipos de Pergunta</h1>
   <hr class="hr-ufop">
@endsection

@section('content')


   <div class="panel panel-default">
      <div class="panel-heading contains-button">
         <a class="btn btn-primary pull-right" role="button"
         style="color: white" href="{{route('questionType.create')}}">Novo Curso</a>
         <p class="panel-title contains-buttons pull-left">TIPOS DE PERGUNTAS</p>
         <span class="clearfix"></span>
      </div>
      <div class="panel-body">
         @include('alert-message.success')
         @include('alert-message.error')
         @include('question-type.question-types-list')
      </div>
   </div>


@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
