<table id="index-table" class="table table-hover table-col-condensed table-ufop table-striped table-bordered table-responsive">

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
            <td>{{$professor->nome . " " . $professor->sobrenome}}</td>
            <td>{{$professor->email}}</td>
            <td>{{$professor->areas_interesse}}</td>
            <td>{{$professor->departamento->cod_departamento}}</td>
            <td>
               <a class="btn btn-primary-ufop btn-xs" role="button"
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
