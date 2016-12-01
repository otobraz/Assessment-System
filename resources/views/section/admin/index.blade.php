@extends('layout.admin.base')

@section('title')
   Gerenciar | Turmas
@endsection

@section('content-header')
   <h1>Editar Turma</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="container-fluid">
      <div class="panel panel-default">
         <div class="panel-heading contains-buttons">
            <a class="btn btn-primary pull-right" role="button"
            style="color: white" href="{{route('section.import')}}">Importar Turmas</a>
            <p class="panel-title contains-buttons pull-left">TURMAS</p>
            <span class="clearfix"></span>
         </div>
         <div class="panel-body">
            @include('alert-message.success')
            @include('alert-message.error')
            @include('section.admin.sections-list')
         </div>
      </div>
   </div>

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
