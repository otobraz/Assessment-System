<table id="index-table" class="table table-striped table-bordered table-col-condensed table-ufop table-hover">

   <thead>
      <tr>
         <th>Id</th>
         <th>Nome</th>
         <th>CPF</th>
         <th>E-mail</th>
         <th>Departamento</th>
         <th>Detalhes</th>
         <th>Excluir</th>
      </tr>
   </thead>

   <tbody>
      @foreach($professors as $professor)
         <tr>
            <td align="center">{{$professor->id}}</td>
            <td>{{$professor->nome_completo}}</td>
            <td align="center">{{$professor->usuario}}</td>
            <td>{{$professor->email}}</td>
            <td align="center">{{$professor->departamento->cod_departamento}}</td>
            <td align="center">
               <a class="btn btn-info btn-xs" role="button"
               style="color: white" href="{{route('professor.show', encrypt($professor->id))}}">Detalhes</a>
            </td>
            <td align="center">
               <a type="button" class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal" data-action="professor/{{encrypt($professor->id)}}">Excluir</a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>

@include('professor.admin.delete-modal')
