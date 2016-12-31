@extends('layout.professor.base')

@section('title')
   Gerenciar | Turmas
@endsection

@section('content')

   @include('section.professor.sections-list')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
