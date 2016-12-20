@extends('layout.student.base')

@section('title')
   Meus Questionários
@endsection

{{-- @section('content-header')
<h1>Meus Questionários</h1>
<hr class="hr-ufop">
@endsection --}}

@section('content')

   @include('alert-message.success')
   @include('alert-message.error')
   @include('survey.student.surveys-list')

@endsection

@section('myScripts')

@endsection
