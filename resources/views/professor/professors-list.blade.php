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
            <td>{{$professor->nome}}</td>
            <td>{{$professor->sobrenome}}</td>
            <td>{{$professor->usuario}}</td>
            <td>{{$professor->email}}</td>
            <td>{{$professor->departamento->cod_departamento}}</td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="professor/{{encrypt($professor->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>
