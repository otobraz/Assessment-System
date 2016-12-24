@foreach ($sectionsGroup as $year => $semesters)
   @foreach ($semesters as $semester => $sections)

      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">QUESTIONÁRIOS - {{$year . "/" . $semester}}</h3>
            <div class="box-tools pull-right">
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
         </div><!-- /.box-header -->
         <div class="box-body">
            <table class="table table-ufop table-col-condensed table-striped table-responsive">

               <thead>
                  <tr>
                     <th>Disciplina</th>
                     <th>Turma</th>
                     <th>Professor</th>
                     <th>Título</th>
                     <th>Disponibilização</th>
                     <th>Status</th>
                     <th>Respostas</th>
                     <th>Detalhes</th>
                  </tr>
               </thead>

               <tbody>
                  @foreach($sections as $section)
                     @foreach ($section->questionarios->sortByDesc('id') as $survey)
                        <tr>
                           <td>{{$section->disciplina->disciplina}}</td>
                           <td>{{$section->cod_turma}}</td>
                           <td>{{$survey->professor->nome . " " . $survey->professor->sobrenome}}</td>
                           <td>{{$survey->titulo}}</td>
                           <td>{{date("d/m/y", strtotime($survey->pivot->created_at))}}</td>
                           <td>
                              @if($survey->pivot->aberto)
                                 Aberto
                              @else
                                 Fechado
                              @endif
                           </td>
                           <td align="center">
                              @if (isset($responses[$survey->pivot->id]))
                                 <a class="btn btn-primary btn-xs" role="button"
                                 style="color: white" href="{{action('ResponseController@show', encrypt($responses[$survey->pivot->id]->id))}}">Ver resposta</a>
                              @else
                                 <a class="btn btn-primary-ufop btn-xs" role="button"
                                 style="color: white" href="{{action('ResponseController@create', encrypt($survey->pivot->id))}}">Responder</a>
                              @endif
                           </td>
                           <td align="center">
                              <a class="btn btn-info btn-xs" role="button"
                              style="color: white" href="{{action('SurveyController@show', encrypt($survey->id))}}">Detalhes</a>
                           </td>
                        </tr>
                     @endforeach

                  @endforeach
               </tbody>

            </table>
         </div><!-- /.box-body -->
      </div><!-- /.box -->

   @endforeach
@endforeach
