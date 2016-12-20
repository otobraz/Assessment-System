@extends('layout.admin.base')

@section('title')
   Criar | Departamento
@endsection

@section('content-header')
   <h1>Criar novo departamento</h1>
   <hr>
@endsection

@section('content')

   <div class="col-md-offset-3 col-md-6">
      <div class="panel panel-default">
         <div class="panel-body">
            <form class="form-signin" method="POST" action="{{action('DepartmentController@store')}}">
               {{ csrf_field() }}
               <fieldset>
                  <div class="form-group">
                     <label for="department">Departamento:</label>
                     <input class="form-control input-xlarge" type="text" name="department" id="department"
                     placeholder="Nome do departamento" autofocus required
                     oninvalid="setCustomValidity('Informe o nome do departamento.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <div class="form-group">
                     <label for="initials">Sigla:</label>
                     <input class="form-control input-xlarge " type="text" name="initials" id="initials"
                     placeholder="Sigla" required
                     oninvalid="setCustomValidity('Informe a sigla do departamento.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>

                  <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                  <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-check-square-o"></i> Criar</button>
               </fieldset>
            </form>
         </div>
      </div>
   </div>
@endsection
