<table class="table table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Nome</th>
         <th>Sobrenome</th>
         <th>CPF</th>
         <th>E-mail</th>
         <th>Curso</th>
         <th></th>
      </tr>
   </thead>

   <tbody>
      @foreach($students as $student)
         <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->first_name}}</td>
            <td>{{$student->last_name}}</td>
            <td>{{$student->username}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->major->major}}</td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="aluno/{{encrypt($student->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>

      @endforeach

   </tbody>

</table>
