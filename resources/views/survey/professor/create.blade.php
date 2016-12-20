@extends('layout.professor.base')

@section('title')
   Criar Questionário
@endsection

{{-- @section('content-header')
   <h1>Criar Questionário</h1>
   <hr class="hr-ufop">
@endsection --}}

@section('content')

   <div class="col-md-10">
      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">Criar Questionário</h3>
            <div class="box-tools pull-right">
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
         </div><!-- /.box-header -->

         <div class="box-body">

            <form class="form-signin" id="questions-form" method="POST" action="{{action('SurveyController@store')}}">

               {{ csrf_field() }}

               <fieldset>

                  <div id="section-select-panel" class="panel panel-default">
                     <div class="panel-body">

                        <div class="form-group">
                           <label for="name">Título:</label>
                           <input type="text" name="name" class="form-control" id="name" placeholder="Informe o título do questionário" required>
                        </div>

                        <div class="form-group">
                           <label for="description">Descrição:</label>
                           <textarea class="form-control" name="description" id="description" placeholder="Detalhes sobre o questionário, objetivos, justificativa, etc."></textarea>
                        </div>

                        <div class="form-group">
                           <label for="sections">Disponibilizar questionário às turmas:</label>
                           <input type="hidden" name="sections[]">
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

                  <button type="button" class="btn btn-primary-ufop" name="btn-blank-question">Criar pergunta</i></button>

                  <button type="button" class="btn btn-primary-ufop" name="btn-select-question">Selecionar pergunta</button>

                  <button class="btn btn-primary-ufop pull-right" type="submit"><i class="fa fa-check-square-o"></i> Finalizar</button>

               </fieldset>
            </form>
         </div>
      </div>
   </div>

   <div class="col-md-2">
      <div class="panel panel-default fixed">
         <div class="panel-body">
            <button type="button" class="btn btn-block btn-primary-ufop" name="btn-blank-question">Criar pergunta</button>
            <hr class="hr-ufop">
            <button type="button" class="btn btn-block btn-primary-ufop" name="btn-select-question">Selecionar Pergunta</button>
         </div>

      </div>
   </div>

@endsection

@section('myScripts')

   <script src="{{asset('/js/surveyCreateQuestion.js')}}"></script>

   <script src="{{asset('/js/selectQuestion.js')}}"></script>

   <script src="{{asset('/js/addInput.js')}}"></script>

@endsection
