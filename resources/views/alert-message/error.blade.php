@if(session()->has('errorMessage'))
   <div class="alert alert-danger fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{session()->has('errorMessage')}}
   </div>

@endif
