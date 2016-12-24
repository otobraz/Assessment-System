<table id="index-table" class="table table-ufop table-bordered table-col-condensed table-striped table-responsive">
   <thead>
      <tr>
         <th>Id</th>
         <th>Código</th>
         <th>Disciplina</th>
         <th>Departamento</th>
         <th>Editar</th>
         <th>Excluir</th>
      </tr>

   </thead>

   <tbody>
      @foreach($courses as $course)
         <tr>
            <td align="center">{{$course->id}}</td>
            <td align="center">{{$course->cod_disciplina}}</td>
            <td>{{$course->disciplina}}</td>
            <td align="center">{{$course->departamento->cod_departamento}}</td>
            <td align="center">
               <a role="button" class="btn btn-warning btn-xs" href="{{route('course.edit', encrypt($course->id))}}">Editar</a>
            </td>
            <td align="center">
               <a role="button" class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal" data-action="disciplina/{{encrypt($course->id)}}">Excluir</a>
            </td>
         </tr>
      @endforeach
   </tbody>
</table>

@include('course.delete-modal')
