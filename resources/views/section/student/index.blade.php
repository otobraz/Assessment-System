@extends('layout.student.base')

@section('title')
   Minhas turmas
@endsection

{{-- @section('content-header')
   <h1>Minhas Turmas</h1>
   <hr class="hr-ufop">
@endsection --}}

@section('content')

   @include('section.student.sections-list')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
