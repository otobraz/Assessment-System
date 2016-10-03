@extends('layout.admin.base')

@section('title')
   Gerenciar | Turmas
@endsection

@section('content-header')
   <h1>Editar Turma</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="container">
      <div class="panel panel-default">
         <div class="panel-heading">
            <p class="panel-title">CLASSES</p>
         </div>
         <div class="panel-body">
            @include('alert-message.success')
            @include('section.sections-list')
         </div>
      </div>
   </div>

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
