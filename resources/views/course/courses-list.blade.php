<table class="table table-ufop table-responsive">
   <thead>
      <tr>
         <th>Id</th>
         <th>Código</th>
         <th>Disciplina</th>
         <th>Departamento</th>
         <th></th>
         <th></th>
      </tr>

   </thead>
   
   <tbody>
      @foreach($courses as $course)
         <tr>
            <td>{{$course->id}}</td>
            <td>{{$course->cod_disciplina}}</td>
            <td>{{$course->disciplina}}</td>
            <td>{{$course->departamento->cod_departamento}}</td>
            <td>
               <a href="{{route('course.edit', encrypt($course->id))}}"><i class="fa fa-lg fa-pencil-square-o"></i></a>
            </td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="disciplina/{{encrypt($course->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>
      @endforeach
   </tbody>
</table>

@include('course.delete-modal')
