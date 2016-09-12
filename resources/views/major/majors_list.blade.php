<div class="table">
   <table class="table table-striped table-responsive">

      <tr>
         <th>Id</th>
         <th>Curso</th>
         <th>Sigla</th>
         <th></th>
         <th></th>
      </tr>

      @foreach($majors as $major)
         <tr>
            <td>{{$major->id}}</td>
            <td>{{$major->major}}</td>
            <td>{{$major->initials}}</td>
            <td>
               <a href="{{route('major.edit', encrypt($major->id))}}"><i class="fa fa-lg fa-pencil-square-o"></i></a>
            </td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="cursos/{{encrypt($major->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>
      @endforeach
   </table>
</div>

@include('major.delete_modal')
