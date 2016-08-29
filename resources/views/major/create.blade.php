@extends('dashboard.dashboard_base')

@section('title')
   Criar Curso
@endsection

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')
   <div class="container">
      <div class="col-md-offset-3 col-md-6">
         <form class="form-signin" method="POST" action="{{url('create/curso')}}">
            {{ csrf_field() }}
            <fildset>
               <legend>Criar novo Curso</legend>
               <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                  <input class="form-control input-xlarge" type="text" name="major" id="major"
                     placeholder="Nome do curso" autofocus required
                     oninvalid="setCustomValidity('Informe o nome do curso.')"
                     oninput="setCustomValidity('')">
               </div>
               <br/>
               <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                  <input class="form-control input-xlarge " type="text" name="initials" id="initials"
                     placeholder="Sigla" required
                     oninvalid="setCustomValidity('Informe a sigla do curso.')"
                     oninput="setCustomValidity('')"
                  >
               </div>
               <br/>
               <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
               <button class="btn btn-primary" type="submit"><i class="fa fa-check-square-o"></i> Criar</button>
            </fildset>
         </form>
      </div>
   </div>
@endsection
