<table id="index-table" class="table table-hover table-col-condensed table-ufop table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Matrícula</th>
         <th>Nome</th>
         <th>Sobrenome</th>
         <th>CPF</th>
         <th>E-mail</th>
         <th>Curso</th>
         <th>Ações</th>
      </tr>
   </thead>

   <tbody>
      @foreach($students as $student)
         <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->matricula}}</td>
            <td>{{$student->nome}}</td>
            <td>{{$student->sobrenome}}</td>
            <td>{{$student->usuario}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->curso->curso}}</td>
            <td>
               <a type="button" class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal" data-action="aluno/{{encrypt($student->id)}}">Excluir</a>
            </td>
         </tr>

      @endforeach

   </tbody>

</table>
