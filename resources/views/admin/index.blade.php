@extends('dashboard.dashboard_base')

@section('title')
   Administradores | Gerenciar
@endsection

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')

   <div class="container">
      <div class="col-md-offset-2 col-md-8">

         <a class="btn btn-primary" role="button"
         style="color: white" href="{{route('admin.create')}}"><i class="fa fa-lg fa-plus-square-o"></i> Cadastrar Administrador</a>

         <br/><br/>

         @include('admin.admins_list')

      </div>
   </div>

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
