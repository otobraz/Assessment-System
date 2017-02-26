<table id="index-table" class="table table-ufop table-col-condensed table-bordered table-striped table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Título</th>
         <th>Professor</th>
         <th>Data de criação</th>
         <th>Detalhes</th>
      </tr>
   </thead>

   <tbody>
      @foreach($surveys as $survey)
         <tr>
            <td align="center">{{$survey->id}}</td>
            <td>{{$survey->titulo}}</td>
            <td>{{$survey->professor->nomeCompleto}}</td>
            <td align="center">{{date("d/m/y", strtotime($survey->created_at))}}</td>
            <td align="center">
               <a class="btn btn-info btn-xs" role="button"
               style="color: white" href="{{action('SurveyController@show', encrypt($survey->id))}}">Detalhes</a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>
