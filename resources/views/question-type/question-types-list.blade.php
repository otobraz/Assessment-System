<table class="table table-ufop table-responsive">

   <thead>
      <tr>
         <th>Id</th>
         <th>Tipo</th>
         <th></th>
         <th></th>
      </tr>
   </thead>

   <tbody>
      @foreach($questionTypes as $questionType)
         <tr>
            <td>{{$questionType->id}}</td>
            <td>{{$questionType->type}}</td>
            <td>
               <a href="{{route('questionType.edit', encrypt($questionType->id))}}"><i class="fa fa-lg fa-pencil-square-o"></i></a>
            </td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="tipo/{{encrypt($questionType->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>


@include('question-type.delete-modal')
