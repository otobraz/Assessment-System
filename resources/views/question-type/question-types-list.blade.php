<table class="table table-ufop table-bordered table-striped table-col-condensed table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Tipo</th>
         <th>Editar</th>
         <th>Excluir</th>
      </tr>
   </thead>

   <tbody>
      @foreach($questionTypes as $questionType)
         <tr>
            <td align="center">{{$questionType->id}}</td>
            <td>{{$questionType->tipo}}</td>
            <td align="center">
               <a role="button" class="btn btn-warning btn-xs" href="{{route('questionType.edit', encrypt($questionType->id))}}">Editar</a>
            </td>
            <td align="center">
               <a role="button" class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal" data-action="tipo/{{encrypt($questionType->id)}}">Excluir</a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>


@include('question-type.delete-modal')
