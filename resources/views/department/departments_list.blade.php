<div class="table ">
   <table class="table table-striped table-hover">

      <tr>
         <th>Id</th>
         <th>Departamento</th>
         <th>Sigla</th>
      </tr>

      @foreach($departments as $department)
         <tr>
            <td>{{$department->id}}</td>
            <td>{{$department->department}}</td>
            <td>{{$department->initials}}</td>
         </tr>
      @endforeach

   </table>
</div>
