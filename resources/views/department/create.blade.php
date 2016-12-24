@extends('layout.admin.base')

@section('title')
   Departamento | Criar
@endsection

@section('content')

   <div class="col-md-offset-3 col-md-6">
      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">CRIAR DEPARTAMENTO</h3>
         </div>
         <div class="box-body">
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
         </div><!-- /.box-body -->
      </div>

   </div>
@endsection
