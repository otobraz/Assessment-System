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
            <table class="table table-ufop table-bordered table-col-condensed table-striped table-responsive">

               <thead>
                  <tr>
                     <th>Turma</th>
                     <th>Cod. Disciplina</th>
                     <th>Disciplina</th>
                     <th>Departamento</th>
                     <th>Semestre</th>
                     <th>Detalhes</th>
                  </tr>
               </thead>


               <tbody>
                  @foreach($sections as $section)
                     <tr>
                        <td align="center">{{$section->cod_turma}}</td>
                        <td align="center">{{$section->disciplina->cod_disciplina}}</td>
                        <td>{{$section->disciplina->disciplina}}</td>
                        <td align="center">{{$section->disciplina->departamento->cod_departamento}}</td>
                        <td align="center">{{$section->ano . "/" . $section->semestre}}</td>
                        <td align="center"><a class="btn btn-info btn-xs" role="button"
                           style="color: white" href="{{route('section.show', encrypt($section->id))}}">Detalhes</a>
                        </td>
                     </tr>
                  @endforeach
               </tbody>

            </table>
         </div><!-- /.box-body -->
      </div><!-- /.box -->


   @endforeach

@endforeach
