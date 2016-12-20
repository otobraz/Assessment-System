<table class="table table-ufop table-responsive">

   <thead>
      <tr>
         <th>Título</th>
         <th>Disciplina</th>
         <th>Turma</th>
         <th>Período</th>
         <th>Professor</th>
         <th></th>
      </tr>
   </thead>

   <tbody>
      @foreach($sections as $section)
         @foreach ($section->questionarios as $survey)
            <tr>
               <td>{{$survey->titulo}}</td>
               <td>{{$section->disciplina->disciplina}}</td>
               <td>{{$section->cod_turma}}</td>
               <td>{{$section->ano . "/" . $section->semestre}}</td>
               <td>{{$survey->professor->nome . " " . $survey->professor->sobrenome}}</td>
               <td>
                  <a class="btn btn-primary-ufop" role="button"
                  style="color: white" href="{{action('ResponseController@create', [encrypt($survey->id), encrypt($section->id)])}}">Responder</a>
               </td>
            </tr>
         @endforeach

      @endforeach
   </tbody>

</table>
