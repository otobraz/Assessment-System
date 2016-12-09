@extends('layout.admin.base')

@section('title')
   Criar Tipo de Pergunta
@endsection

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')

   <div class="col-md-offset-4 col-md-4">
      <form class="form-signin" method="POST" action="{{action('QuestionTypeController@store')}}">
         {{ csrf_field() }}
         <fieldset>
            <legend>Criar novo tipo de pergunta</legend>

            <div class="form-group">
               <label for="questionType">Nome do tipo:</label>
               <input class="form-control input-xlarge" type="text" name="type" id="type"
               placeholder="Tipo" autofocus required
               oninvalid="setCustomValidity('Informe o tipo.')"
               oninput="setCustomValidity('')"
               >
            </div>

            <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
            <button class="btn btn-primary" type="submit"><i class="fa fa-check-square-o"></i> Criar</button>
         </fieldset>
      </form>
   </div>

@endsection
