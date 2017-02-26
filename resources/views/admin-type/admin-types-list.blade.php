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
      @foreach($adminTypes as $adminType)
         <tr>
            <td align="center">{{$adminType->id}}</td>
            <td>{{$adminType->tipo}}</td>
            <td align="center">
               <a class="btn btn-warning btn-xs" role="button" href="{{route('adminType.edit', encrypt($adminType->id))}}">Editar</a>
            </td>
            <td align="center">
               <a class="btn btn-danger btn-xs" role="button" data-toggle="modal" href="#deleteModal" data-action="tipo/{{encrypt($adminType->id)}}">Excluir</a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>


@include('admin-type.delete-modal')
