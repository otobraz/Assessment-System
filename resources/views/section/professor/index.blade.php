@extends('layout.professor.base')

@section('title')
   Gerenciar | Turmas
@endsection

{{-- @section('content-header')
   <h1>Minhas Turmas</h1>
   <hr class="hr-ufop">
@endsection --}}

@section('content')

   {{-- <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">TURMAS</h3>
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body">
         @include('alert-message.success')
         @include('alert-message.error')
         @include('section.professor.sections-list')
      </div><!-- /.box-body -->
   </div><!-- /.box --> --}}

   @include('section.professor.sections-list')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
