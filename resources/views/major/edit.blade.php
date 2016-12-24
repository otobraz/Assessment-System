@extends('layout.admin.base')

@section('title')
   Curso | Editardww
@endsection

{{-- @section('content-header')
   <h1>Editar Curso</h1>
   <hr class="hr-ufop">
@endsection --}}

@section('content')

   <div class="col-md-offset-3 col-md-6">

      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">EDITAR CURSO</h3>
            <div class="box-tools pull-right">
               </button>
            </div>
         </div>
         <div class="box-body">

            @include('alert-message.success')
            @include('alert-message.error')

            <form class="form-signin" method="POST" action="{{action('MajorController@update', encrypt($major->id))}}">

               {{ method_field('PUT') }}

               <fieldset>

                  {{ csrf_field() }}

                  <div class="form-group">
                     <label for="major">Nome do curso:</label>
                     <input class="form-control input-xlarge" type="text" name="major" id="major"
                     placeholder="Nome do curso" value="{{$major->curso}}" autofocus required
                     oninvalid="setCustomValidity('Informe o nome do curso.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <div class="form-group">
                     <label for="initials">Sigla:</label>
                     <input class="form-control input-xlarge " type="text" name="initials" id="initials"
                     placeholder="Sigla" value="{{$major->cod_curso}}" required
                     oninvalid="setCustomValidity('Informe a sigla do curso.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <button class="btn btn-danger pull-left"  type="button" data-toggle="modal" data-action="http://localhost:8000/curso/{{encrypt($major->id)}}" href="#deleteModal"> Excluir</button>
                  <div class="pull-right">
                     <button class="btn btn-default" type="button"
                     onclick="history.go(-1)"> Cancelar</button>
                     <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-pencil-square-o"></i> Editar</button>
                  </div>

               </fieldset>
            </form>
         </div><!-- /.box-body -->
      </div>
   </div>

@include('major.delete-modal')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
