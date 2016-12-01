<table id="index-table" class="table table-striped table-bordered table-responsive">

   <thead>
      <tr>
         <th>Nome</th>
         <th>E-mail</th>
         <th>Áreas de Interesse</th>
         <th>Departamento</th>
      </tr>
   </thead>

   <tbody>
      @foreach($professors as $professor)
         <tr>
            <td>{{$professor->nome . " " . $professor->sobrenome}}</td>
            <td>{{$professor->email}}</td>
            <td>{{$professor->areas_interesse}}</td>
            <td>{{$professor->departamento->cod_departamento}}</td>
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
