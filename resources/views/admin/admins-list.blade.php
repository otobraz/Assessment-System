<table id="table-index" class="table table-col-condensed table-hover table-striped table-ufop table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Usuário</th>
         <th>Nome</th>
         <th>Sobrenome</th>
         <th>E-mail</th>
         <th>Ações</th>
      </tr>
   </thead>

   <tbody>
      @foreach($admins as $admin)
         <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->usuario}}</td>
            <td>{{$admin->nome}}</td>
            <td>{{$admin->sobrenome}}</td>
            <td>{{$admin->email}}</td>
            <td>
               <a type="button" class="btn btn-success btn-xs" href="{{route('admin.edit', encrypt($admin->id))}}"> <i class="fa fa-edit"></i> Editar</a>
               <a type="button" class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal" data-action="admin/{{encrypt($admin->id)}}"><i class="fa fa-trash-o"></i> Excluir</a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>

@include('admin.delete-modal')
