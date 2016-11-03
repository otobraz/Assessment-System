<table class="table table-ufop table-responsive">

   <thead>
      <tr>
         <th>Título</th>
      </tr>
   </thead>

   <tbody>

      @foreach ($surveys as $survey)
         <tr>
            <td>{{$survey->titulo}}</td>
            <td>
               <a class="btn btn-primary" role="button"
               style="color: white" href="#">Editar</a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>
