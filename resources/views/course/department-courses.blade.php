<table id="index-table" class="table table-ufop table-bordered table-col-condensed table-striped table-responsive">
   <thead>
      <tr>
         <th>Id</th>
         <th>Código</th>
         <th>Disciplina</th>
         <th>Departamento</th>
      </tr>

   </thead>

   <tbody>
      @foreach($courses as $course)
         <tr>
            <td align="center">{{$course->id}}</td>
            <td align="center">{{$course->cod_disciplina}}</td>
            <td>{{$course->disciplina}}</td>
            <td align="center">{{$course->departamento->cod_departamento}}</td>
         </tr>
      @endforeach
   </tbody>
</table>
