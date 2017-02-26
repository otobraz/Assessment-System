@extends('layout.professor.base')

@section('title')
   Turmas
@endsection

@section('content')

   @include('section.professor.sections-list')

   @if($sectionsGroup->isEmpty())

      <div class="box box-primary-ufop">
         <div class="box-body">
            <h1 align="center">Você não possui turmas</h1>
         </div>
      </div>

   @endif

@endsection

@section('myScripts')

@endsection
