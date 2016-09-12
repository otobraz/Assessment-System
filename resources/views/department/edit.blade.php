@extends('dashboard.dashboard_base')

@section('title')
   Editar | Departamento
@endsection

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-offset-4 col-md-6">
            <legend>Editar Departamento</legend>
         </div>
      </div>
      <div class="row">
         <div class="col-md-offset-4 col-md-4">
            <form class="form-signin" method="POST" action="{{action('DepartmentController@update', encrypt($department->id))}}">

               {{ csrf_field() }}
               {{ method_field('PUT') }}

               <input type="hidden" name="id" value="{{encrypt($department->id)}}">

               <fildset>

                  <div class="form-group">
                     <label for="department">Nome do departamento:</label>
                     <input class="form-control input-xlarge" type="text" name="department" id="department"
                     placeholder="Nome do curso" value="{{$department->department}}" autofocus required
                     oninvalid="setCustomValidity('Informe o nome do curso.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <div class="form-group">
                     <label for="initials">Sigla:</label>
                     <input class="form-control input-xlarge " type="text" name="initials" id="initials"
                     placeholder="Sigla" value="{{$department->initials}}" required
                     oninvalid="setCustomValidity('Informe a sigla do curso.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <button class="btn btn-warning pull-right"  type="button" data-toggle="modal" data-action="http://localhost:8000/departamentos/{{encrypt($department->id)}}" href="#deleteModal"> Excluir</button>
                  <div class="pull-left">
                     <button class="btn btn-default" type="button" onclick="window.location='{{route('department.index')}}'"> Cancelar</button>
                     <button class="btn btn-primary" type="submit"><i class="fa fa-pencil-square-o"></i> Editar</button>
                  </div>

               </fildset>
            </form>
         </div>
      </div>
   </div>

   @include('department.delete_modal')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
