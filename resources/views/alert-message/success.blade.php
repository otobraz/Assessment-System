@if(session()->has('successMessage'))
   <div class="alert alert-success fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{session()->get('successMessage')}}
   </div>
@endif
