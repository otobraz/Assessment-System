<table class="table table-ufop table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Usuário</th>
         <th>Nome</th>
         <th>Sobrenome</th>
         <th>E-mail</th>
         <th></th>
         <th></th>
      </tr>
   </thead>

   <tbody>
      @foreach($admins as $admin)
         <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->username}}</td>
            <td>{{$admin->first_name}}</td>
            <td>{{$admin->last_name}}</td>
            <td>{{$admin->email}}</td>
            <td>
               <a href="{{route('admin.edit', encrypt($admin->id))}}"><i class="fa fa-lg fa-pencil-square-o"></i></a>
            </td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="admin/{{encrypt($admin->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>

@include('admin.delete-modal')
