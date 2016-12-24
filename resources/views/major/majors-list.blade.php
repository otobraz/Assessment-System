<table class="table table-ufop table-striped table-bordered table-col-condensed table-responsive">
   <thead>
      <tr>
         <th>Id</th>
         <th>Curso</th>
         <th>Sigla</th>
         <th>Editar</th>
         <th>Excluir</th>
      </tr>

   </thead>

   <tbody>
      @foreach($majors as $major)
         <tr>
            <td align="center">{{$major->id}}</td>
            <td>{{$major->curso}}</td>
            <td align="center">{{$major->cod_curso}}</td>
            <td align="center">
               <a role="button" class="btn btn-warning btn-xs" href="{{route('major.edit', encrypt($major->id))}}">Editar</a>
            </td>
            <td align="center">
               <a role="button" class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal" data-action="curso/{{encrypt($major->id)}}">Excluir</a>
            </td>
         </tr>
      @endforeach
   </tbody>
</table>

@include('major.delete-modal')
