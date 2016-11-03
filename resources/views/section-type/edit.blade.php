@extends('layout.admin.base')

@section('title')
   Editar Tipo de Orientação
@endsection

@section('content-header')
   <h1>Editar tipo de orientação</h1>
   <hr class="hr-ufop">
@endsection

@section('content')
   <div class="container">
      <div class="col-md-offset-3 col-md-6">
         <div class="panel panel-default">
            <div class="panel-body">

               @include('alert-message.success')
               @include('alert-message.error')

               <form class="form-signin" method="POST" action="{{action('SectionTypeController@update', encrypt($sectionType->id))}}">

                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                  <input type="hidden" name="id" value="{{encrypt($sectionType->id)}}">

                  <fildset>

                     <div class="form-group">
                        <label for="sectionType">Tipo:</label>
                        <input class="form-control input-xlarge" type="text" name="type" id="type"
                        placeholder="Nome do tipo" value="{{$sectionType->tipo}}" autofocus required
                        oninvalid="setCustomValidity('Informe o tipo.')"
                        oninput="setCustomValidity('')"
                        >
                     </div>

                     <button class="btn btn-warning pull-right"  type="button" data-toggle="modal" data-action="http://localhost:8000/classes/tipo/{{encrypt($sectionType->id)}}" href="#deleteModal"> Excluir</button>
                     <div class="pull-left">
                        <button class="btn btn-default" type="button" onclick="history.go(-1)"> Cancelar</button>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-pencil-square-o"></i> Editar</button>
                     </div>

                  </fildset>
               </form>
            </div>
         </div>
      </div>
   </div>

   @include('section-type.delete-modal')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
