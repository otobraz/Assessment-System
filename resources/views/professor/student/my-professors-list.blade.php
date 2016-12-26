<table class="table table-ufop table-bordered table-col-condensed table-striped table-responsive">

   <thead>
      <tr>
         <th>Nome</th>
         <th>E-mail</th>
         <th>Departamento</th>
         <th>Áreas de Interesse</th>
         <th>Disciplina</th>
         <th>Semestre</th>
         <th>Detalhes</th>
      </tr>
   </thead>

   <tbody>
      @foreach($mySections as $section)
         @foreach($section->professores as $professor)
            <tr>
               <td>{{$professor->nomeCompleto}}</td>
               <td>{{$professor->email}}</td>
               <td align="center">{{$professor->departamento->cod_departamento}}</td>
               <td>{{$professor->areas_interesse}}</td>
               <td>{{$section->disciplina->disciplina}}</td>
               <td align="center">{{$section->ano . "/" . $section->semestre}}</td>
               <td align="center">
                  <a class="btn btn-info btn-xs" role="button"
                  style="color: white" href="{{route('professor.show', encrypt($professor->id))}}">Detalhes</a>
               </td>
            </tr>
         @endforeach
      @endforeach
   </tbody>

</table>
