<table class="table table-ufop table-responsive">

   <thead>
      <tr>
         <th>Título</th>
         <th>Turma</th>
         <th>Período</th>
         <th>Professor</th>
         <th></th>
      </tr>
   </thead>

   <tbody>
      @foreach($surveys as $survey)
         <tr>
            <td>{{$survey->name}}</td>
            <td>{{$survey->section->course->course}}</td>
            <td>{{$survey->section->year . "/" . $survey->section->semester}}</td>
            <td>{{$survey->professor->first_name . " " . $survey->professor->last_name}}</td>
            <td>
               <a class="btn btn-primary" role="button"
               style="color: white" href="{{action('ResponseController@create', encrypt($survey->id))}}">Responder</a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>
