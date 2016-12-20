@extends('layout.admin.base')

@section('title')
   Tipo de Orientação | Criar
@endsection

@section('content')

   <div class="col-md-offset-3 col-md-6">
      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">CRIAR TIPO DE ORIENTAÇÃO</h3>
         </div>
         <div class="box-body">

            <form class="form-signin" method="POST" action="{{action('GuidanceTypeController@store')}}">

               {{ csrf_field() }}

               <fieldset>

                  <div class="form-group">
                     <label for="guidance-type">Nome do tipo:</label>
                     <input class="form-control input-xlarge" type="text" name="guidance-type" id="guidance-type"
                     placeholder="Tipo" autofocus required
                     oninvalid="setCustomValidity('Informe o tipo.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>

                  <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                  <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-check-square-o"></i> Criar</button>
               </fieldset>
            </form>

         </div><!-- /.box-body -->
      </div>

   </div>

@endsection
