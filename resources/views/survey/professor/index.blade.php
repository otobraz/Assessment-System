@extends('layout.professor.base')

@section('title')
   Gerenciar Questionários
@endsection

{{-- @section('content-header')
   <h1>Meus Questionários</h1>
   <hr class="hr-ufop">
@endsection --}}

@section('content')

      {{-- <div class="panel panel-default">
         <div class="panel-heading contains-buttons">
            <a class="btn btn-primary pull-right" role="button"
            style="color: white" href="{{route('survey.create')}}">Criar questionário</a>
            <p class="panel-title contains-buttons pull-left">QUESTIONÁRIOS</p>
            <span class="clearfix"></span>
         </div>
         <div class="panel-body">
            @include('alert-message.success')
            @include('alert-message.error')
            @include('survey.professor.surveys-list')
         </div>
      </div> --}}

      @include('survey.professor.surveys-list')

@endsection

@section('myScripts')

@endsection
