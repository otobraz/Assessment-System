@extends('dashboard.dashboard_base')

@section('title')
   Editar Curso
@endsection

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-offset-4 col-md-6">
            <legend>Editar Curso: {{$major->major}}</legend>
         </div>
      </div>
      <div class="row">
         <div class="col-md-offset-4 col-md-4">
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
                  <button class="btn btn-warning pull-right"  type="button" data-toggle="modal" data-action="http://localhost:8000/cursos/{{encrypt($major->id)}}" href="#deleteModal"> Excluir</button>
                  <div class="pull-left">
                     <button class="btn btn-default" type="button" onclick="window.location='{{route('major.index')}}'"> Cancelar</button>
                     <button class="btn btn-primary" type="submit"><i class="fa fa-pencil-square-o"></i> Editar</button>
                  </div>

               </fildset>
            </form>
         </div>
      </div>
   </div>

   @include('major.delete_modal')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
