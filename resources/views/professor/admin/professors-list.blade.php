<table id="index-table" class="table table-striped table-bordered table-ufop table-hover">

   <thead>
      <tr>
         <th>Id</th>
         <th>Nome</th>
         <th>CPF</th>
         <th>E-mail</th>
         <th>Departamento</th>
         <th>Ações</th>
      </tr>
   </thead>

   <tbody>
      @foreach($professors as $professor)
         <tr>
            <td>{{$professor->id}}</td>
            <td>{{$professor->nome_completo}}</td>
            <td>{{$professor->usuario}}</td>
            <td>{{$professor->email}}</td>
            <td>{{$professor->departamento->cod_departamento}}</td>
            <td>
               <a type="button" class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal" data-action="professor/{{encrypt($professor->id)}}">Excluir</a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>

@include('professor.admin.delete-modal')
