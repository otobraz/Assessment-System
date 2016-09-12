@extends('dashboard.dashboard_base')

@section('title')
   Criar | Departamento
@endsection

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')
   <div class="container">
      <div class="col-md-offset-4 col-md-4">
         <form class="form-signin" method="POST" action="{{action('DepartmentController@store')}}">
            {{ csrf_field() }}
            <fildset>
               <legend>Criar novo Departamento</legend>

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
               <button class="btn btn-primary" type="submit"><i class="fa fa-check-square-o"></i> Criar</button>
            </fildset>
         </form>
      </div>
   </div>
@endsection
