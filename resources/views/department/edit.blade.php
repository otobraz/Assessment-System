@extends('layout.admin.base')

@section('title')
   Editar | Departamento
@endsection

@section('content-header')
   <h1>Editar Departamento</h1>
   <hr>
@endsection

@section('content')
   <div class="row">
      <div class="col-md-offset-3 col-md-6">
         <div class="panel panel-default">
            <div class="panel-body">

               @include('alert-message.success')
               @include('alert-message.error')

               <form class="form-signin" method="POST" action="{{action('DepartmentController@update', encrypt($department->id))}}">

                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                  <input type="hidden" name="id" value="{{encrypt($department->id)}}">

                  <fieldset>

                     <div class="form-group">
                        <label for="department">Nome do departamento:</label>
                        <input class="form-control input-xlarge" type="text" name="department" id="department"
                        placeholder="Nome do curso" value="{{$department->departamento}}" autofocus required
                        oninvalid="setCustomValidity('Informe o nome do curso.')"
                        oninput="setCustomValidity('')"
                        >
                     </div>
                     <div class="form-group">
                        <label for="initials">Sigla:</label>
                        <input class="form-control input-xlarge " type="text" name="initials" id="initials"
                        placeholder="Sigla" value="{{$departamento->cod_departamen}}" required
                        oninvalid="setCustomValidity('Informe a sigla do curso.')"
                        oninput="setCustomValidity('')"
                        >
                     </div>
                     <button class="btn btn-warning pull-right"  type="button" data-toggle="modal" data-action="http://localhost:8000/departamento/{{encrypt($department->id)}}" href="#deleteModal"> Excluir</button>
                     <div class="pull-left">
                        <button class="btn btn-default" type="button" onclick="history.go(-1)"> Cancelar</button>
                        <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-pencil-square-o"></i> Editar</button>
                     </div>

                  </fieldset>
               </form>
            </div>
         </div>
      </div>
   </div>

   @include('department.delete-modal')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
