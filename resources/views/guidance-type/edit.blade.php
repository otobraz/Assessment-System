@extends('layout.admin.base')

@section('title')
   Tipo de Orientação | Editar
@endsection

{{-- @section('content-header')
   <h1>Editar Tipo de Pergunta</h1>
   <hr class="hr-ufop">
@endsection --}}

@section('content')

   <div class="col-md-offset-3 col-md-6">
      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">EDITAR TIPO DE ORIENTAÇÃO</h3>
         </div>
         <div class="box-body">

            <form class="form-signin" method="POST" action="{{action('GuidanceTypeController@update', encrypt($guidanceType->id))}}">

               {{ csrf_field() }}

               {{ method_field('PUT') }}

               <fieldset>

                  <div class="form-group">
                     <label for="guidance-type">Nome do tipo:</label>
                     <input class="form-control input-xlarge" type="text" name="guidance-type" id="guidance-type"
                     placeholder="Tipo" autofocus oninvalid="setCustomValidity('Informe o tipo.')" oninput="setCustomValidity('')" value="{{$guidanceType->tipo}}" required>
                  </div>

                  <button class="btn btn-danger pull-left"  type="button" data-toggle="modal" data-action="http://localhost:8000/orientacoes/tipo/{{encrypt($guidanceType->id)}}" href="#deleteModal"> Excluir</button>
                  <div class="pull-right">
                     <button class="btn btn-default" type="button" onclick="history.go(-1)"> Cancelar</button>
                     <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-pencil-square-o"></i> Editar</button>
                  </div>

               </fieldset>
            </form>

         </div><!-- /.box-body -->
      </div>

   </div>

   @include('question-type.delete-modal')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
