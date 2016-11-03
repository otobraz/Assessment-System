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
      @foreach($sectionTypes as $sectionType)
         <tr>
            <td>{{$sectionType->id}}</td>
            <td>{{$sectionType->tipo}}</td>
            <td>
               <a href="{{route('sectionType.edit', encrypt($sectionType->id))}}"><i class="fa fa-lg fa-pencil-square-o"></i></a>
            </td>
            <td>
               <a data-toggle="modal" href="#deleteModal" data-action="tipo/{{encrypt($sectionType->id)}}"><i class="fa fa-lg fa-trash-o"></i></a>
            </td>
         </tr>
      @endforeach
   </tbody>

</table>

@include('section-type.delete-modal')
