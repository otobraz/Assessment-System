<table class="table table-ufop table-col-condensed table-bordered table-striped table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Tipo</th>
         <th>Editar</th>
         <th>Excluir</th>
      </tr>
   </thead>

   <tbody>
      @foreach($guidanceTypes as $guidanceType)
         <tr>
            <td align="center">{{$guidanceType->id}}</td>
            <td>{{$guidanceType->tipo}}</td>
            <td align="center">
               <a class="btn btn-warning btn-xs" role="button" href="{{route('guidanceType.edit', encrypt($guidanceType->id))}}">Editar</a>
            </td>
            <td align="center">
               <a class="btn btn-danger btn-xs" role="button" data-toggle="modal" href="#deleteModal" data-action="tipo/{{encrypt($guidanceType->id)}}">Excluir</a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>


@include('question-type.delete-modal')
