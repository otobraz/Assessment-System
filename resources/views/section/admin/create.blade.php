@extends('layout.admin.base')

@section('title')
   Criar novo tipo de classe
@endsection

@section('content')

   <div class="col-md-offset-4 col-md-4">
      <form class="form-signin" method="POST" action="{{action('SectionTypeController@store')}}">
         {{ csrf_field() }}
         <fieldset>
            <legend>Criar novo tipo de classe</legend>

            <div class="form-group">
               <label for="sectionType">Nome do tipo:</label>
               <input class="form-control input-xlarge" type="text" name="type" id="type"
               placeholder="Tipo" autofocus required
               oninvalid="setCustomValidity('Informe o tipo.')"
               oninput="setCustomValidity('')"
               >
            </div>

            <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
            <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-check-square-o"></i> Criar</button>
         </fieldset>
      </form>
   </div>

@endsection
