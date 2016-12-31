@extends('layout.professor.base')

@section('title')
   Gerenciar Questionários
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">QUESTIONÁRIOS</h3>
         <div class="box-tools pull-right">
            <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{action('SurveyController@create')}}"><i class="fa fa-file"> </i> Criar Questionário</a>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">
         @include('alert-message.success')
         @include('alert-message.error')
         @include('survey.professor.surveys-list')
      </div>
   </div>

@endsection

@section('myScripts')

@endsection
