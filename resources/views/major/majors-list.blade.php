<table class="table table-ufop table-responsive">
   <thead>
      <tr>
         <th>Id</th>
         <th>Curso</th>
         <th>Sigla</th>
         <th></th>
         <th></th>
      </tr>

   </thead>

   <tbody>
      @foreach($majors as $major)
         <tr>
            <td>{{$major->id}}</td>
            <td>{{$major->curso}}</td>
            <td>{{$major->cod_curso}}</td>
            <td>
               <a href="{{route('major.edit', encrypt($major->id))}}"><i class="fa fa-lg fa-pencil-square-o"></i></a>
            </td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="curso/{{encrypt($major->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>
      @endforeach
   </tbody>
</table>

@include('major.delete-modal')
