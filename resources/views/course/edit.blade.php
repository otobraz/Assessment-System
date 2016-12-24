@extends('layout.admin.base')

@section('title')
   Disciplina | Editar
@endsection

@section('content')

   <div class="col-md-offset-3 col-md-6">

      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">DISCIPLINAS</h3>
         </div>
         <div class="box-body">

            @include('alert-message.success')
            @include('alert-message.error')

            <form class="form-signin" method="POST" action="{{action('CourseController@update', encrypt($course->id))}}">

               {{ csrf_field() }}
               {{ method_field('PUT') }}

               <input type="hidden" name="id" value="{{encrypt($course->id)}}">

               <fieldset>

                  <div class="form-group">
                     <label for="initials">Código da disciplina:</label>
                     <input class="form-control input-xlarge " type="text" name="code" id="code"
                     placeholder="Código" value="{{$course->cod_disciplina}}" required
                     oninvalid="setCustomValidity('Informe o código da disciplina.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>

                  <div class="form-group">
                     <label for="course">Nome da Disciplina:</label>
                     <input class="form-control input-xlarge" type="text" name="course" id="course"
                     placeholder="Nome da disciplina" value="{{$course->disciplina}}" autofocus required
                     oninvalid="setCustomValidity('Informe o nome da disciplina.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>

                  <div class="form-group">
                     <label for="department">Departamento:</label>
                     <select name="department" id="department" class="form-control">
                        @foreach ($departments as $department)
                           <option value="{{$department->id}}"><p></p>{{$department->cod_departamento . " - " . $department->departamento}}</option>
                        @endforeach
                     </select>
                  </div>

                  <button class="btn btn-danger pull-left"  type="button" data-toggle="modal" data-action="http://localhost:8000/curso/{{encrypt($course->id)}}" href="#deleteModal"> Excluir</button>
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

   @include('course.delete-modal')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
