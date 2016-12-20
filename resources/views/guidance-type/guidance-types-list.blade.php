<table class="table table-ufop table-col-condensed table-striped table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Tipo</th>
         <th>Editar Registro</th>
         <th>Excluir Registro</th>
      </tr>
   </thead>

   <tbody>
      @foreach($guidanceTypes as $guidanceType)
         <tr>
            <td>{{$guidanceType->id}}</td>
            <td>{{$guidanceType->tipo}}</td>
            <td>
               <a class="btn btn-primary-ufop btn-xs" role="button" href="{{route('guidanceType.edit', encrypt($guidanceType->id))}}">Editar</a>
            </td>
            <td>
               <a class="btn btn-danger btn-xs" role="button" data-toggle="modal" href="#deleteModal" data-action="tipo/{{encrypt($guidanceType->id)}}">Excluir</a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>


@include('question-type.delete-modal')
