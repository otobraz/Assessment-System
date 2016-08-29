<div class="table ">
   <table class="table table-striped table-hover">

      <tr>
         <th>Id</th>
         <th>Nome</th>
         <th>Sobrenome</th>
         <th>CPF</th>
         <th>E-mail</th>
         <th>Curso</th>
      </tr>

      @foreach($students as $student)
         <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->first_name}}</td>
            <td>{{$student->last_name}}</td>
            <td>{{$student->username}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->major->major}}</td>
         </tr>
      @endforeach

   </table>
</div>
