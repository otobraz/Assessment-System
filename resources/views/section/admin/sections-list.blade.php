<table id="index-table" class="table table-ufop table-striped table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Disciplina</th>
         <th>Cód. Turma</th>
         <th>Departamento</th>
         <th>Ano</th>
         <th>Semestre</th>
         <th>Excluir</th>
      </tr>
   </thead>


   <tbody>
      @foreach($sections as $section)
         <tr>
            <td>{{$section->id}}</td>
            <td>{{$section->disciplina->disciplina}}</td>
            <td>{{$section->cod_turma}}</td>
            <td>{{$section->disciplina->departamento->cod_departamento}}</td>
            <td>{{$section->ano}}</td>
            <td>{{$section->semestre}}</td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="tipo/{{encrypt($section->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>

@include('section.admin.delete_modal')
