@extends('layout.admin.base')

@section('title')
   Editar Tipo de Pergunta
@endsection

@section('content-header')
   <h1>Editar Tipo de Pergunta</h1>
   <hr class="hr-ufop">
@endsection

@section('content')
   <div class="container">
      <div class="col-md-offset-3 col-md-6">
         <div class="panel panel-default">
            <div class="panel-body">

               @include('alert-message.success')
               @include('alert-message.error')

               <form class="form-signin" method="POST" action="{{action('QuestionTypeController@update', encrypt($questionType->id))}}">

                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                  <input type="hidden" name="id" value="{{encrypt($questionType->id)}}">

                  <fildset>

                     <div class="form-group">
                        <label for="questionType">Tipo:</label>
                        <input class="form-control input-xlarge" type="text" name="type" id="type"
                        placeholder="Nome do tipo" value="{{$questionType->type}}" autofocus required
                        oninvalid="setCustomValidity('Informe o tipo.')"
                        oninput="setCustomValidity('')"
                        >
                     </div>

                     <button class="btn btn-warning pull-right"  type="button" data-toggle="modal" data-action="http://localhost:8000/perguntas/tipo/{{encrypt($questionType->id)}}" href="#deleteModal"> Excluir</button>
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

   @include('question-type.delete-modal')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
