@extends('layout.professor.base')

@section('title')
   Gerenciar | Perguntas
@endsection

@section('content')

   @include('question.professor.question-list')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
