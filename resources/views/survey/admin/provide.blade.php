@extends('layout.admin.base')

@section('title')
   Questionário | Disponibilizar
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">{{$survey->titulo}}</h3>
      </div><!-- /.box-header -->

      <div class="box-body">

         <form class="form-signin" id="questions-form" method="POST" action="{{action('SurveyController@generalSurveyAttach')}}">

            {{ csrf_field() }}

            <fieldset>

               <input type="hidden" name="survey-id" value="{{$survey->id}}">

               <div class="form-group">
                  <label for="departments">Disponibilizar questionário às turmas dos departamentos:</label>
                  @foreach ($departments as $department)
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="departments[]" value="{{$department->id}}">
                           {{$department->departamento}}
                        </label>
                     </div>
                  @endforeach
               </div>

            </fieldset>
            <hr class="hr-ufop">
            <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
            <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-check"></i> Disponibilizar</button>

         </form>
      </div>
   </div>

@endsection
