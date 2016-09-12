<div class="table ">
   <table class="table table-striped table-hover">

      <tr>
         <th>Id</th>
         <th>Departamento</th>
         <th>Sigla</th>
         <th></th>
         <th></th>
      </tr>

      @foreach($departments as $department)
         <tr>
            <td>{{$department->id}}</td>
            <td>{{$department->department}}</td>
            <td>{{$department->initials}}</td>
            <td>
               <a href="{{route('department.edit', encrypt($department->id))}}"><i class="fa fa-lg fa-pencil-square-o"></i></a>
            </td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="departamentos/{{encrypt($department->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>
      @endforeach

   </table>
</div>

@include('department.delete_modal')
