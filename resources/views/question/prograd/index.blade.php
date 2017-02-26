@extends('layout.prograd.base')

@section('title')
   Gerenciar | Perguntas
@endsection

{{-- @section('content-header')
<h1>Tipos de Pergunta</h1>
<hr class="hr-ufop">
@endsection --}}

@section('content')

   @include('question.prograd.question-list')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
