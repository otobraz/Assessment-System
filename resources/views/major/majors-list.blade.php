<table class="table table-ufop table-responsive">
   <thead>
      <tr>
         <th>Id</th>
         <th>Curso</th>
         <th>Sigla</th>
         <th></th>
      </tr>

   </thead>

   <tbody>
      @foreach($majors as $major)
         <tr>
            <td>{{$major->id}}</td>
            <td>{{$major->major}}</td>
            <td>{{$major->initials}}</td>
            <td>
               <a class="btn btn-primary btn-xs" role="button" href="{{route('major.edit', encrypt($major->id))}}"><i class="fa fa-lg fa-pencil-square-o"></i> Editar</a>
               <a class="btn btn-primary btn-xs" data-toggle="modal" href="#deleteModal" data-action="curso/{{encrypt($major->id)}}"><i class="fa fa-lg fa-trash-o"></i> Excluir</a>
            </td>
         </tr>
      @endforeach
   </tbody>
</table>

@include('major.delete-modal')
