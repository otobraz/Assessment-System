@extends('layout.admin.base')

@section('title')
   Gerenciar | Perguntas
@endsection

@section('content')

   @include('question.admin.question-list')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
