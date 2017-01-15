@foreach ($sectionsGroup as $year => $semesters)

   @foreach ($semesters as $semester => $sections)

      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">TURMAS - {{$year . "/" . $semester}}</h3>
            <div class="box-tools pull-right">
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
         </div><!-- /.box-header -->
         <div class="box-body">
            <table class="table table-ufop table-col-condensed table-bordered table-striped table-responsive">

               <thead>
                  <tr>
                     <th>Turma</th>
                     <th>Cod. Disciplina</th>
                     <th>Disciplina</th>
                     <th>Professor</th>
                     <th>Departamento</th>
                     <th>Semestre</th>
                     <th>Detalhes</th>
                  </tr>
               </thead>


               <tbody>
                  @foreach($sections as $section)

                     <tr>
                        <td align="center" rowspan="{{count($section->professores)}}">{{$section->cod_turma}}</td>
                        <td align="center" rowspan="{{count($section->professores)}}">
                           {{$section->disciplina->cod_disciplina}}
                        </td>
                        <td rowspan="{{count($section->professores)}}">{{$section->disciplina->disciplina}}</td>
                        <td>{{$section->professores[0]->nome_completo}}</td>
                        <td align="center" rowspan="{{count($section->professores)}}">
                           {{$section->disciplina->departamento->cod_departamento}}
                        </td>
                        <td align="center" rowspan="{{count($section->professores)}}">{{$section->ano . "/" . $section->semestre}}</td>
                        <td rowspan="{{count($section->professores)}}" align="center">
                           <a class="btn btn-info btn-xs" role="button" style="color: white" href="{{route('section.show', encrypt($section->id))}}">
                              Detalhes
                           </a>
                        </td>
                     </tr>
                     @if (count($section->professores) > 1)
                        @foreach (array_slice($section->professores,1) as $professor)
                           <tr>
                              <td>{{$professor->nome_completo}}</td>
                           </tr>
                        @endforeach
                     @endif

                  @endforeach
               </tbody>

            </table>
         </div><!-- /.box-body -->
      </div><!-- /.box -->


   @endforeach

@endforeach
