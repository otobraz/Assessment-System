@extends('layout.admin.base')

@section('title')
   Tipo de Administrador | Editar
@endsection

{{-- @section('content-header')
   <h1>Editar Tipo de Pergunta</h1>
   <hr class="hr-ufop">
@endsection --}}

@section('content')

   <div class="col-md-offset-3 col-md-6">
      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">EDITAR TIPO DE ADMINISTRADOR</h3>
         </div>
         <div class="box-body">

            <form class="form-signin" method="POST" action="{{action('AdminTypeController@update', encrypt($adminType->id))}}">

               {{ csrf_field() }}

               {{ method_field('PUT') }}

               <fieldset>

                  <div class="form-group">
                     <label for="admin-type">Tipo:</label>
                     <input class="form-control input-xlarge" type="text" name="admin-type" id="admin-type"
                     placeholder="Tipo" autofocus oninvalid="setCustomValidity('Informe o tipo.')" oninput="setCustomValidity('')" value="{{$adminType->tipo}}" required>
                  </div>

                  <button class="btn btn-danger pull-left"  type="button" data-toggle="modal" data-action="http://localhost:8000/orientacoes/tipo/{{encrypt($adminType->id)}}" href="#deleteModal"> Excluir</button>
                  <div class="pull-right">
                     <button class="btn btn-default" type="button" onclick="history.go(-1)"> Cancelar</button>
                     <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-pencil-square-o"></i> Editar</button>
                  </div>

               </fieldset>
            </form>

         </div><!-- /.box-body -->
      </div>

   </div>

   @include('admin-type.delete-modal')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
