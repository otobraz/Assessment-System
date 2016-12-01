<table class="table table-ufop table-responsive">

   <thead>
      <tr>
         <th>Turma</th>
         <th>Cod. Disciplina</th>
         <th>Disciplina</th>
         <th>Professor(a)</th>
         <th>Ano</th>
         <th>Semestre</th>
         <th></th>
      </tr>
   </thead>


   <tbody>
      @foreach($sections as $section)
         <tr>
            <td>{{$section->cod_turma}}</td>
            <td>{{$section->disciplina->cod_disciplina}}</td>
            <td>{{$section->disciplina->disciplina}}</td>
            <td>
            @foreach ($section->professores as $i => $professor)
               @if($i == 0)
                  {{$professor->nome_completo}}
               @else
                  {{" / " . $professor->nome_completo}}
               @endif
            @endforeach
            </td>
            <td>{{$section->ano}}</td>
            <td>{{$section->semestre}}</td>
            <td>
               <a href="{{route('section.show', encrypt($section->id))}}"><i class="fa fa-lg fa-eye"></i></a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>

@include('section.delete_modal')
