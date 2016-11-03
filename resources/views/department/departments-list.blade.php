<table class="table table-ufop table-responsive">
   <thead>
      <tr>
         <th>Id</th>
         <th>Departamento</th>
         <th>Sigla</th>
         <th></th>
         <th></th>
      </tr>
   </thead>

   <tbody>
      @foreach($departments as $department)
         <tr>
            <td>{{$department->id}}</td>
            <td>{{$department->departamento}}</td>
            <td>{{$department->cod_departamento}}</td>
            <td>
               <a href="{{route('department.edit', encrypt($department->id))}}"><i class="fa fa-lg fa-pencil-square-o"></i></a>
            </td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="departamento/{{encrypt($department->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>


@include('department.delete-modal')
