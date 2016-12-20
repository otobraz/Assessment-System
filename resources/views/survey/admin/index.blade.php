@extends('layout.admin.base')

@section('title')
   Questionários
@endsection

@section('content-header')
   <h1>Gerenciar Questionários</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="panel panel-default">
      <div class="panel-heading contains-buttons">
         <a class="btn btn-primary-ufop pull-right" role="button"
         style="color: white" href="{{route('survey.create')}}">Novo Questionário</a>
         <p class="panel-title contains-buttons pull-left">QUESTIONÁRIOS</p>
         <span class="clearfix"></span>
      </div>
      <div class="panel-body">
         @include('alert-message.success')
         @include('alert-message.error')
         @include('survey.surveys-list')
      </div>
   </div>

@endsection

@section('myScripts')

@endsection
