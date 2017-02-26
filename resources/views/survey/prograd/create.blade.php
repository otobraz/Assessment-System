@extends('layout.prograd.base')

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

               <form class="form-signin" id="questions-form" method="POST" action="{{action('SurveyController@store')}}">
                  {{ csrf_field() }}

                  <fieldset>

                     <div id="section-select-panel" class="panel panel-default">
                        <div class="panel-body">

                           <div class="form-group">
                              <label for="name">Título:</label>
                              <input type="text" name="name" class="form-control" id="name" placeholder="Informe o título do questionário">
                           </div>

                           <div class="form-group">
                              <label for="description">Descrição:</label>
                              <textarea class="form-control" name="description" id="description" placeholder="Detalhe o questionário, objetivos, etc."></textarea>
                           </div>

                           <div class="form-group">
                              <label for="section">Atribuir questionário as turmas:</label>
                              @foreach ($sections as $section)
                                 <div class="checkbox">
                                    <label>
                                       <input type="checkbox" name="sections[]" value="{{$section->id}}">
                                       {{$section->disciplina->disciplina . " - " . $section->ano . "/" . $section->semestre}}
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

                     <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-check-square-o"></i> Criar</button>

                  </fieldset>
               </form>

            </div>
         </div>
      </div>

      <div class="col-md-2">
         <div class="panel panel-default fixed">
            <div class="panel-body">
               <button type="button" class="btn btn-block btn-primary-ufop" name="btn-blank-question">Nova Questão</button>
               <hr class="hr-ufop">
               <button type="button" class="btn btn-block btn-primary-ufop" name="btn-select-question">Selecionar Questão</button>
            </div>

         </div>
      </div>
   </div>
</div>

@endsection

@section('myScripts')

   <script src="{{asset('/js/surveyCreateQuestion.js')}}"></script>

   <script src="{{asset('/js/selectQuestion.js')}}"></script>

   <script src="{{:asset('/js/addInput.js')}}"></script>

@endsection
