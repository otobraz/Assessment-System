@foreach ($surveys as $survey)

   <div class="box box-solid-ufop box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">{{$survey->titulo}}</h3>
         {{-- . " - " . date("d/m/y - H:i:s", strtotime($survey->created_at)) --}}
         <div class="box-tools pull-right">
            <a class="btn btn-info btn-sm" role="button"
            style="color: white" href="{{action('SurveyController@show', encrypt($survey->id))}}"><i class="fa fa-info-circle"></i> Detalhes</a>
            <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{action('SurveyController@getResults', encrypt($survey->id))}}"><i class="fa fa-bar-chart"></i> Resultado Geral</a>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">

         <form class="form-signin" method="POST" autocomplete="off" action="{{action('SurveyController@postResults')}}">

            <fieldset>

               {{ csrf_field() }}

               <input type="hidden" name="surveyId" value="{{$survey->id}}">

               <table class="table table-bordered table-col-condensed table-hover clickable-row table-striped table-responsive">

                  <thead>
                     <tr>
                        <th colspan="8" class="text-center">DISPONIBILIZAÇÕES
                           <a class="btn btn-primary-ufop btn-xs pull-right" role="button"
                           style="color: white" href="{{action('SurveyController@provide', encrypt($survey->id))}}"></i> Disponibilizar</a>
                        </th>
                     </tr>
                     <tr>
                        <th>Disciplina (selecione para comparar)</th>
                        <th>Turma</th>
                        {{-- <th>Departamento</th> --}}
                        <th>Semestre</th>
                        <th>Disponibilização</th>
                        <th>Status</th>
                        <th>Fechar/Abrir</th>
                        <th>Respostas</th>
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
                              {{-- <td>{{$section->disciplina->departamento->cod_departamento}}</td> --}}
                              <td align="center">{{$section->ano . "/" . $section->semestre}}</td>
                              <td align="center">
                                 {{date("d/m/y", strtotime($section->pivot->created_at))}}
                              </td>
                              <td>
                                 @if($section->pivot->aberto)
                                    Aberto
                                 @else
                                    Fechado
                                 @endif
                              </td>
                              <td align="center">
                                 @if($section->pivot->aberto)
                                    <a class="btn btn-danger btn-xs" role="button"
                                    style="color: white" href="{{route('survey.close', encrypt($section->pivot->id))}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>  Fechar</a>
                                 @else
                                    <a class="btn btn-success btn-xs" role="button"
                                    style="color: white" href="{{route('survey.open', encrypt($section->pivot->id))}}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  Abrir</a>
                                 @endif
                              </td>
                              <td align="center">
                                 <a class="btn btn-info btn-xs" role="button"
                                 style="color: white" href="{{route('survey.classResults', encrypt($section->pivot->id))}}"><i class="fa fa-bar-chart"></i> Resultado</a>
                              </td>
                           </tr>
                        @endforeach

                     </div>

                     <tr>
                        <td colspan="8"><button class="btn btn-primary-ufop" type="submit"><span class="glyphicon glyphicon-stats" aria-label="Comparar"></span> Comparar</button></td>
                     </tr>

                  </tbody>

               </table>

            </fieldset>

         </form>

      </div><!-- /.box-body -->
   </div><!-- /.box -->
@endforeach

@section('myScripts')

   <script src="{{asset('/js/clickableRow.js')}}"></script>

@endsection
