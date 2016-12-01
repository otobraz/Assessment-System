@extends('layout.admin.base')

@section('title')
   Criar Disciplina
@endsection

@section('content-header')
   <h1>Criar nova disciplina</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="col-md-offset-3 col-md-6">
      <div class="panel panel-default">
         <div class="panel-body">
            <form class="form-signin" method="POST" action="{{action('CourseController@store')}}">
               {{ csrf_field() }}
               <fieldset>

                  <div class="form-group">
                     <label for="initials">Código da Disciplina:</label>
                     <input class="form-control input-xlarge " type="text" name="code" id="code"
                     value="{{old('code')}}"
                     placeholder="Código (Ex.: CEA000, CSI000)" required
                     oninvalid="setCustomValidity('Informe a sigla do curso.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>

                  <div class="form-group">
                     <label for="course">Nome da disciplina:</label>
                     <input class="form-control input-xlarge" type="text" name="course" id="course"
                     value="{{old('course')}}"
                     placeholder="Nome da disciplina" autofocus required
                     oninvalid="setCustomValidity('Informe o nome da disciplina.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>

                  @if (session()->has('errorMessage'))
                     <div class="form-group has-error">
                        <label for="department">Departamento:</label>
                        <select name="department" id="department" class="form-control">
                           <option value="">Selecione o departamento</option>
                           @foreach ($departments as $department)
                              <option value="{{$department->id}}"><p></p>{{$department->cod_departamento . " - " . $department->departamento}}</option>
                           @endforeach
                        </select>
                        <p class="help-block">{{session()->get('errorMessage')}}</p>
                     </div>
                  @else
                     <div class="form-group">
                        <label for="department">Departamento:</label>
                        <select name="department" id="department" class="form-control">
                           <option value="">Selecione o departamento</option>
                           @foreach ($departments as $department)
                              <option value="{{$department->id}}"><p></p>{{$department->cod_departamento . " - " . $department->departamento}}</option>
                           @endforeach
                        </select>
                     </div>
                  @endif

                  <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                  <button class="btn btn-primary" type="submit"><i class="fa fa-check-square-o"></i> Criar</button>
               </fieldset>
            </form>
         </div>
      </div>


   </div>
@endsection
