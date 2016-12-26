<table id="index-table" class="table table-col-condensed table-ufop table-striped table-bordered table-responsive">

   <thead>
      <tr>
         <th>Nome</th>
         <th>E-mail</th>
         <th>Áreas de Interesse</th>
         <th>Departamento</th>
         <th>Detalhes</th>
      </tr>
   </thead>

   <tbody>
      @foreach($professors as $professor)
         <tr>
            <td>{{$professor->nomeCompleto}}</td>
            <td>{{$professor->email}}</td>
            <td>{{$professor->areas_interesse}}</td>
            <td align="center">{{$professor->departamento->cod_departamento}}</td>
            <td align="center">
               <a class="btn btn-info btn-xs" role="button"
               style="color: white" href="{{route('professor.show', encrypt($professor->id))}}">Detalhes</a>
            </td>
         </tr>
      @endforeach
   </tbody>
   <tfoot>
      <tr>
         <th>Nome</th>
         <th>E-mail</th>
         <th>Departamento</th>
      </tr>
   </tfoot>

</table>
