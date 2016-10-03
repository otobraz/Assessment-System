@extends('layout.admin.base')

@section('title')
   Editar Curso
@endsection

@section('content-header')
   <h1>Editar Curso</h1>
   <hr class="hr-ufop">
@endsection

@section('content')
   <div class="container">
      <div class="col-md-offset-3 col-md-6">
         <div class="panel panel-default">
            <div class="panel-body">

               @include('alert-message.success')
               @include('alert-message.error')

               <form class="form-signin" method="POST" action="{{action('MajorController@update', encrypt($major->id))}}">

                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                  <input type="hidden" name="id" value="{{encrypt($major->id)}}">

                  <fildset>

                     <div class="form-group">
                        <label for="major">Nome do curso:</label>
                        <input class="form-control input-xlarge" type="text" name="major" id="major"
                        placeholder="Nome do curso" value="{{$major->major}}" autofocus required
                        oninvalid="setCustomValidity('Informe o nome do curso.')"
                        oninput="setCustomValidity('')"
                        >
                     </div>
                     <div class="form-group">
                        <label for="initials">Sigla:</label>
                        <input class="form-control input-xlarge " type="text" name="initials" id="initials"
                        placeholder="Sigla" value="{{$major->initials}}" required
                        oninvalid="setCustomValidity('Informe a sigla do curso.')"
                        oninput="setCustomValidity('')"
                        >
                     </div>
                     <button class="btn btn-warning pull-right"  type="button" data-toggle="modal" data-action="http://localhost:8000/curso/{{encrypt($major->id)}}" href="#deleteModal"> Excluir</button>
                     <div class="pull-left">
                        <button class="btn btn-default" type="button"
                        onclick="history.go(-1)"> Cancelar</button>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-pencil-square-o"></i> Editar</button>
                     </div>

                  </fildset>
               </form>
            </div>
         </div>
      </div>
   </div>

   @include('major.delete-modal')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
