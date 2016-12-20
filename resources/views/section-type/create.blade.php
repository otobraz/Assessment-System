@extends('dashboard.dashboard_base')

@section('title')
   Criar novo tipo de orientação
@endsection

@section('content-header')
   <h1>Novo Tipo de Orientação</h1>
   <hr class="hr-ufop">
@endsection

@section('content')
   <div class="container">
      <div class="col-md-offset-3 col-md-6">
         <div class="panel panel-default">
            <div class="panel-body">
               <form class="form-signin" method="POST" action="{{action('SectionTypeController@store')}}">
                  {{ csrf_field() }}
                  <fieldset>

                     <div class="form-group">
                        <label for="sectionType">Nome do tipo:</label>
                        <input class="form-control input-xlarge" type="text" name="type" id="type"
                        placeholder="Tipo" autofocus required
                        oninvalid="setCustomValidity('Informe o tipo.')"
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
   </div>
@endsection
