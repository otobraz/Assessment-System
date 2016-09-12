<div class="table ">
   <table class="table table-striped table-responsive">
      <tr>
         <th>Id</th>
         <th>Usuário</th>
         <th>Nome</th>
         <th>Sobrenome</th>
         <th>E-mail</th>
         <th></th>
         <th></th>
      </tr>

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
   </table>
</div>

@include('admin.delete_modal')
