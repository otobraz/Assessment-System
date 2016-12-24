<table class="table table-ufop table-col-condensed table-striped table-bordered table-responsive">
   <thead>
      <tr>
         <th>Id</th>
         <th>Departamento</th>
         <th>Sigla</th>
         <th>Editar</th>
         <th>Excluir</th>
      </tr>
   </thead>

   <tbody>
      @foreach($departments as $department)
         <tr>
            <td align="center">{{$department->id}}</td>
            <td>{{$department->departamento}}</td>
            <td align="center">{{$department->cod_departamento}}</td>
            <td align="center">
               <a role"button" class="btn btn-warning btn-xs" href="{{route('department.edit', encrypt($department->id))}}">Editar</a>
            </td>
            <td align="center">
               <a role="button" class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal" data-action="departamento/{{encrypt($department->id)}}">Excluir</a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>


@include('department.delete-modal')
