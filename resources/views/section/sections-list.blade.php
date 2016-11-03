<table class="table table-ufop table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Ano</th>
         <th>Semestre</th>
         <th>Curso</th>
         <th></th>
      </tr>
   </thead>


   <tbody>
      @foreach($sections as $section)
         <tr>
            <td>{{$section->id}}</td>
            <td>{{$section->ano}}</td>
            <td>{{$section->semestre}}</td>
            <td>{{$section->disciplina->disciplina}}</td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="tipo/{{encrypt($section->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>

@include('section.delete_modal')
