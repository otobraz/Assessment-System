<table id="index-table" class="table table-bordered table-striped table-col-condensed table-ufop table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Matrícula</th>
         <th>Nome</th>
         <th>CPF</th>
         <th>E-mail</th>
         <th>Curso</th>
         <th>Excluir</th>
      </tr>
   </thead>

   <tbody>
      @foreach($students as $student)
         <tr>
            <td align="center">{{$student->id}}</td>
            <td align="center">{{$student->matricula}}</td>
            <td>{{$student->nomeCompleto}}</td>
            <td align="center">{{$student->usuario}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->curso->curso}}</td>
            <td align="center">
               <a type="button" class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal" data-action="aluno/{{encrypt($student->id)}}">Excluir</a>
            </td>
         </tr>

      @endforeach

   </tbody>

</table>

@include('student.admin.delete-modal')
