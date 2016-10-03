<table class="table table-ufop table-hover">

   <thead>
      <tr>
         <th>Id</th>
         <th>Nome</th>
         <th>Sobrenome</th>
         <th>CPF</th>
         <th>E-mail</th>
         <th>Departamento</th>
         <th></th>
      </tr>
   </thead>

   <tbody>
      @foreach($professors as $professor)
         <tr>
            <td>{{$professor->id}}</td>
            <td>{{$professor->first_name}}</td>
            <td>{{$professor->last_name}}</td>
            <td>{{$professor->username}}</td>
            <td>{{$professor->email}}</td>
            <td>{{$professor->department->initials}}</td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="professor/{{encrypt($professor->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>
