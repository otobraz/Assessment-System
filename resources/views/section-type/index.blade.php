@extends('layout.admin.base')

@section('title')
   Gerenciar | Tipos de Orientação
@endsection

@section('content-header')
   <h1>Tipos de orientação</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="container">
      <div class="panel panel-default">
         <div class="panel-heading contains-buttons">
            <a class="btn btn-primary-ufop pull-right" role="button"
            style="color: white" href="{{route('sectionType.create')}}">Novo tipo de classe</a>
            <p class="panel-title contains-buttons pull-left">TIPOS DE CLASSES</p>
            <span class="clearfix"></span>
         </div>
         <div class="panel-body">
            @if(session()->has('successMessage'))
               <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{session()->get('successMessage')}}
               </div>
            @endif
            @include('section-type.section-types-list')
         </div>
      </div>
   </div>

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
