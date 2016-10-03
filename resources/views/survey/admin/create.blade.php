@extends('layout.admin.base')

@section('title')
   Criar Questionário
@endsection

@section('content-header')
   <h1>Criar Questionário</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="container">
      <div class="panel panel-default">
         <div class="panel-body">
            <form class="form-signin" method="POST" action="{{action('SurveyController@store')}}">
               <div class="form-group">
                  <label for="section">Atribuir questionário as turmas:</label>
                  @foreach ($sections as $section)
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="sections[]" value="{{$section->id}}">
                           {{$section->course->course . " - " . $section->year . "/" . $section->semester}}
                        </label>
                     </div>
                  @endforeach
               </div>
               <div class="form-group">
                 <label for="name"></label>
                 <input type="text" class="form-control" id="name" placeholder="">
                 <p class="help-block">Help text here.</p>
               </div>
               @include('alert-message.success')
               @include('alert-message.error')
            </div>
         </div>
      </div>

   @endsection

   @section('myScripts')

   @endsection
