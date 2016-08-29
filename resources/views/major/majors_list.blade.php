<div class="table ">
   <table class="table table-striped table-hover">

      <tr>
         <th>Id</th>
         <th>Curso</th>
         <th>Sigla</th>
      </tr>

      @foreach($majors as $major)
         <tr>
            <td>{{$major->id}}</td>
            <td>{{$major->major}}</td>
            <td>{{$major->initials}}</td>
         </tr>
      @endforeach

   </table>
</div>
