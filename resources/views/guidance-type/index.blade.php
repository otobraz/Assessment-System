@extends('layout.admin.base')

@section('title')
   Gerenciar | Tipos de Orientação
@endsection

{{-- @section('content-header')
   <h1>Tipos de Pergunta</h1>
   <hr class="hr-ufop">
@endsection --}}

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">CRIAR TIPO DE ORIENTAÇÃO</h3>
         <div class="box-tolls pull-right">
            <a class="btn btn-primary-ufop pull-right" role="button"
            style="color: white" href="{{route('guidanceType.create')}}">Novo Tipo de Orientação</a>
         </div>
      </div>
      <div class="box-body">

         @include('alert-message.success')
         @include('alert-message.error')
         @include('guidance-type.guidance-types-list')

      </div><!-- /.box-body -->
   </div>


@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
