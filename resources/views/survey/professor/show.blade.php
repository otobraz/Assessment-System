@extends('layout.professor.base')

@section('title')
   Questionário | Detalhes
@endsection

@section('content')

   <div class="box box-primary-ufop collapsed-box">
      <div class="box-header with-border">
         <h3 class="box-title">{{$survey->titulo}}</h3>
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">

         {{-- <h4>{{$survey->titulo}}</h4> --}}
         <h4><small>{{$survey->descricao}}</small></h4>
         <hr class="hr-ufop">

         <fieldset disabled>

            <input type="hidden" name="survey_id" value="{{encrypt($survey->id)}}">

            @foreach ($questions as $question)
               <div class="form-group">
                  @if ($question->tipo->id == 2)

                     <label for="question-{{$question->id}}-radio">{{$question->pergunta}}</label>
                     @foreach ($question->opcoes as $choice)
                        <div class="radio">
                           <label>
                              <input type="radio" name="question-{{$question->id}}-radio"
                              id="question-{{$question->id}}-radio" value="{{$choice->id}}">
                              {{$choice->opcao}}
                           </label>
                        </div>
                     @endforeach

                  @elseif ($question->tipo->id == 3)

                     <label for="question-{{$question->id}}-checkbox">{{$question->pergunta}}</label>
                     @foreach ($question->opcoes as $choice)
                        <div class="checkbox">
                           <label>
                              <input type="checkbox" name="question-{{$question->id}}-checkbox[]" value="{{$choice->id}}">
                              {{$choice->opcao}}
                           </label>
                        </div>
                     @endforeach
                  @else
                     <label for="question-{{$question->id}}-text">{{$question->pergunta}}</label>
                     <textarea class="form-control input-xlarge"
                     rows="1"
                     name="question-{{$question->id}}-text"
                     id="question-{{$question->id}}-text"
                     placeholder="Digite aqui..."
                     ></textarea>
                  @endif
               </div>
            @endforeach

         </fieldset>

      </div>

   </div>


   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">DISPONIBILIZAÇÕES</h3>
         <div class="box-tools pull-right">
            <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{action('SurveyController@overallResult', encrypt($survey->id))}}"><i class="fa fa-bar-chart"></i> Resultado Geral</a>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">

         <form class="form-signin" method="POST" autocomplete="off" action="{{action('SurveyController@comparedResult')}}">

            <fieldset>

               {{ csrf_field() }}

               <input type="hidden" name="surveyId" value="{{$survey->id}}">

               <table class="table table-bordered table-hover table-col-condensed clickable-row table-striped table-responsive">

                  <thead>
                     <tr>
                        <th colspan="8" class="text-center">TURMAS</th>
                     </tr>
                     <tr>
                        <th>Disciplina (selecione para comparar)</th>
                        <th>Turma</th>
                        <th>Departamento</th>
                        <th>Semestre</th>
                        <th>Disponibilização</th>
                        <th>Status</th>
                        {{-- <th>No. Respostas</th> --}}
                        <th>Respostas</th>
                        <th>Resultado</th>
                     </tr>
                  </thead>

                  <tbody>

                     <div class="form-group">

                        @foreach ($survey->turmas()->OrderByDisciplina()->get() as $section)
                           <tr>
                              <td>
                                 <input type="checkbox" name="sections[]" id="{{$section->id}}" value="{{$section->id}}">
                                 {{"  " . $section->disciplina->disciplina}}
                              </td>
                              <td align="center">{{$section->cod_turma}}</td>
                              <td align="center">{{$section->disciplina->departamento->cod_departamento}}</td>
                              <td>{{$section->ano . "/" . $section->semestre}}</td>
                              <td>
                                 {{date("d/m/y", strtotime($section->pivot->created_at))}}
                              </td>
                              <td>
                                 @if($section->pivot->aberto)
                                    Aberto
                                 @else
                                    Fechado
                                 @endif
                              </td>
                              <td align="center"><a class="btn btn-primary btn-xs" role="button"
                                 style="color: white" href="{{route('survey.showResponses', encrypt($section->pivot->id))}}">Respostas</a>
                              </td>
                              <td align="center"><a class="btn btn-info btn-xs" role="button"
                                 style="color: white" href="{{route('survey.classResult', encrypt($section->pivot->id))}}"><i class="fa fa-bar-chart"></i> Resultado</a>
                              </td>
                           </tr>
                        @endforeach

                     </div>

                  </tbody>

                  <tfoot>
                     <tr>
                        @if ($survey->turmas()->OrderByDisciplina()->get()->count() >= 1)
                           <td colspan="8"><button class="btn btn-primary-ufop" type="submit"><span class="glyphicon glyphicon-stats" aria-label="Comparar"></span> Comparar</button></td>
                        @else
                           <td colspan="8"><button disabled class="btn btn-primary-ufop" type="submit"><span class="glyphicon glyphicon-stats" aria-label="Comparar"></span> Comparar</button></td>
                        @endif
                     </tr>
                  </tfoot>
               </table>

            </fieldset>

         </form>

      </div><!-- /.box-body -->
   </div><!-- /.box -->
@endsection
