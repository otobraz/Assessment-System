@extends('layout.admin.base')

@section('title')
   Tipos de Pergunta | Gerenciar
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">TIPOS DE PERGUNTAS</h3>
         <div class="box-tools pull-right">
            <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{route('questionType.create')}}">Novo Tipo de Pergunta</a>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">
         @include('alert-message.success')
         @include('alert-message.error')
         @include('question-type.question-types-list')
      </div>
   </div>

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
