@extends('layout.admin.base')

@section('title')
   Criar Questionário
@endsection

@section('content-header')
   <h1>Criar Questionário</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="row">
      <div class="col-md-10">
         <div class="panel panel-default">
            <div class="panel-body">
               <form class="form-signin" method="POST" action="{{action('SurveyController@store')}}">
                  @include('alert-message.success')
                  @include('alert-message.error')

                  <div id="section-select-panel" class="panel panel-default">
                     <div class="panel-body">
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
                     </div>
                  </div>

                  <hr class="hr-ufop">
                  <h3 class="text-center">Pré-Visualização</h3>
                  <hr class="hr-ufop">

                  <div id="survey-preview-panel" class="panel panel-default">
                     <div class="panel-body">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="panel panel-default fixed">
               <div class="panel-body">
                  <button type="button" class="btn btn-block btn-primary" name="btn-blank-question">Nova Questão</button>
                  <hr class="hr-ufop">
                  <button type="button" class="btn btn-block btn-primary" name="btn-select-question">Selecionar Questão</button>
               </div>

            </div>
         </div>
      </div>
   </div>

@endsection

@section('myScripts')

   <script src="{{URL::asset('/js/createSurvey.js')}}"></script>

@endsection
