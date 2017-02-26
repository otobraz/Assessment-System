<table id="table-index" class="table table-col-condensed table-bordered table-striped table-ufop table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Usuário</th>
         <th>Nome</th>
         <th>Sobrenome</th>
         <th>E-mail</th>
         <th>Tipo</th>
         <th>Editar</th>
         <th>Excluir</th>
      </tr>
   </thead>

   <tbody>
      @foreach($admins as $admin)
         <tr>
            <td align="center">{{$admin->id}}</td>
            <td align="center">{{$admin->usuario}}</td>
            <td>{{$admin->nome}}</td>
            <td>{{$admin->sobrenome}}</td>
            <td>{{$admin->email}}</td>
            <td>{{$admin->tipo->tipo}}</td>
            <td align="center">
               <a role="button" class="btn btn-warning btn-xs" href="{{route('admin.edit', encrypt($admin->id))}}">Editar</a>

            </td>
            <td align="center">
               <a role="button" class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal" data-action="admin/{{encrypt($admin->id)}}">Excluir</a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>

@include('admin.delete-modal')
