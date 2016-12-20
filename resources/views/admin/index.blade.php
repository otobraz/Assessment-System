@extends('layout.admin.base')

@section('title')
   Gerenciar | Administradores
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">ADMINISTRADORES</h3>
         <div class="box-tools pull-right">
            <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{route('admin.create')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Admin</a>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
         </div>
      </div>
      <div class="box-body">
         @include('alert-message.success')
         @include('alert-message.error')
         @include('admin.admins-list')
      </div><!-- /.box-body -->
   </div>

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
