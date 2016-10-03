@extends('layout.admin.base')

@section('title')
   Gerenciar | Professores
@endsection

@section('content-header')
   <h1>Gerenciar Professores</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="container">
      <div class="panel panel-default">
         <div class="panel-heading">
            <p class="panel-title pull-left">PROFESSORES</p>
            <span class="clearfix"></span>
         </div>
         <div class="panel-body">
            @include('alert-message.success')
            @include('alert-message.error')
            @include('professor.professors-list')
         </div>
      </div>
   </div>


@endsection
