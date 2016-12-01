@extends('layout.student.base')

@section('title')
   Questionários
@endsection

@section('content-header')
   <h1>Meus Questionários</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="panel panel-default">
      <div class="panel-heading">
         <p class="panel-title">QUESTIONÁRIOS</p>
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
