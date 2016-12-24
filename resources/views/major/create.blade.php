@extends('layout.admin.base')

@section('title')
   Curso | Criar
@endsection

@section('content')

   <div class="col-md-offset-3 col-md-6">

      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">CRIAR CURSO</h3>
            <div class="box-tools pull-right">
            </div>
         </div>
         <div class="box-body">
            <form class="form-signin" method="POST" action="{{action('MajorController@store')}}">
               {{ csrf_field() }}
               <fieldset>

                  <div class="form-group">
                     <label for="major">Nome do curso:</label>
                     <input class="form-control input-xlarge" type="text" name="major" id="major"
                     placeholder="Nome do curso" autofocus required
                     oninvalid="setCustomValidity('Informe o nome do curso.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <div class="form-group">
                     <label for="initials">Sigla:</label>
                     <input class="form-control input-xlarge " type="text" name="initials" id="initials"
                     placeholder="Sigla" required
                     oninvalid="setCustomValidity('Informe a sigla do curso.')"
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
