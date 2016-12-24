@extends('layout.student.base')

@section('title')
   Questionário | Detalhes
@endsection

@section('content')

   @include('alert-message.success')
   @include('alert-message.error')

   <form class="form-signin" method="POST" autocomplete="off" action="{{action('SurveyController@postResults')}}">
      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">{{$survey->titulo . " - " . date("d/m/y - H:i:s", strtotime($survey->created_at))}}</h3>
            <div class="box-tools pull-right">
               <a class="btn btn-primary-ufop btn-sm" role="button"
               style="color: white" href="{{action('SurveyController@getResults', encrypt($survey->id))}}"><i class="fa fa-bar-chart"></i> Resultado Geral</a>
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
         </div><!-- /.box-header -->

         <div class="box-body">

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
                              <td>{{$section->disciplina->departamento->cod_departamento}}</td>
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
                              <td align="center"><a class="btn btn-primary-ufop btn-xs" role="button"
                                 style="color: white" href="{{route('survey.classResults', encrypt($section->pivot->id))}}"><i class="fa fa-bar-chart"></i> Resultado</a>
                              </td>
                           </tr>
                        @endforeach

                     </div>

                  </tbody>

                  <tfoot>
                     <tr>
                        <td colspan="8"><button class="btn btn-primary-ufop" type="submit"><span class="glyphicon glyphicon-stats" aria-label="Comparar"></span> Comparar</button></td>
                     </tr>
                  </tfoot>
               </table>

            </fieldset>

         </form>

      </div><!-- /.box-body -->
   </div><!-- /.box -->

@endsection

@section('myScripts')

   <script src="{{asset('/js/clickableRow.js')}}"></script>

@endsection
