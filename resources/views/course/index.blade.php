@extends('layout.admin.base')

@section('title')
   Gerenciar | Disciplinas
@endsection

@section('content-header')
   <h1>Gerenciar Disciplinas</h1>
   <hr class="hr-ufop">
@endsection

@section('content')


   <div class="panel panel-default">
      <div class="panel-heading contains-buttons">
         <a class="btn btn-primary-ufop pull-right" role="button"
         style="color: white" href="{{route('course.create')}}">Nova Disciplina</a>
         <p class="panel-title contains-buttons pull-left">DISCIPLINAS</p>
         <span class="clearfix"></span>
      </div>
      <div class="panel-body">
         @include('alert-message.success')
         @include('alert-message.error')
         @include('course.courses-list')
      </div>
   </div>


@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
