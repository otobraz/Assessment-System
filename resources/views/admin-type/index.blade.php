@extends('layout.admin.base')

@section('title')
   Gerenciar | Tipos de Administrador
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">CRIAR TIPO DE ADMINISTRADOR</h3>
         <div class="box-tolls pull-right">
            <a class="btn btn-primary-ufop pull-right btn-sm" role="button"
            style="color: white" href="{{route('adminType.create')}}">Novo Tipo de Administrador</a>
         </div>
      </div>
      <div class="box-body">

         @include('alert-message.success')
         @include('alert-message.error')
         @include('admin-type.admin-types-list')

      </div><!-- /.box-body -->
   </div>


@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
