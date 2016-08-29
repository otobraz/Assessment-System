<div class="table ">
   <table class="table table-striped table-hover">

      <tr>
         <th>Id</th>
         <th>Nome</th>
         <th>Sobrenome</th>
         <th>CPF</th>
         <th>E-mail</th>
         <th>Departamento</th>
      </tr>

      @foreach($professors as $professor)
         <tr>
            <td>{{$professor->id}}</td>
            <td>{{$professor->first_name}}</td>
            <td>{{$professor->last_name}}</td>
            <td>{{$professor->username}}</td>
            <td>{{$professor->email}}</td>
            <td>{{$professor->department->department}}</td>
         </tr>
      @endforeach

   </table>
</div>
