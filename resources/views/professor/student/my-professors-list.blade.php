<table class="table table-striped table-bordered table-responsive">

   <thead>
      <tr>
         <th>Nome</th>
         <th>E-mail</th>
         <th>Departamento</th>
         <th>Disciplina</th>
         <th>Semestre</th>
      </tr>
   </thead>

   <tbody>
      @foreach($mySections as $section)
         @foreach($section->professores as $professor)
            <tr>
               <td>{{$professor->nome . " " . $professor->sobrenome}}</td>
               <td>{{$professor->email}}</td>
               <td>{{$professor->departamento->cod_departamento}}</td>
               <td>{{$section->disciplina->disciplina}}</td>
               <td>{{$section->ano . "/" . $section->semestre}}</td>
            </tr>
         @endforeach
      @endforeach
   </tbody>

</table>
