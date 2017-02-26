@extends('layout.professor.base')

@section('title')
   Questionário | Disponibilizar
@endsection

{{-- @section('content-header')
<h1>Criar Questionário</h1>
<hr class="hr-ufop">
@endsection --}}

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">{{$survey->titulo}}</h3>
      </div><!-- /.box-header -->

      <div class="box-body">

         <form class="form-signin" id="questions-form" method="POST" action="{{action('SurveyController@attach')}}">

            {{ csrf_field() }}

            <fieldset>

               <input type="hidden" name="survey-id" value="{{$survey->id}}">

               <div class="form-group">
                  <label for="sections">Disponibilizar questionário às turmas:</label>
                  @foreach ($sectionsGroup as $year => $groups)
                     @foreach ($groups as $semester => $sections)
                        @foreach ($sections as $section)
                           <div class="checkbox">
                              <label>
                                 <input type="checkbox" name="sections[]" value="{{$section->id}}">
                                 {{$year . "/" . $semester . " - " . "T" . $section->cod_turma . ": " . $section->disciplina->disciplina}}
                              </label>
                           </div>
                        @endforeach
                        <hr class="hr-ufop">
                     @endforeach
                  @endforeach
               </div>

            </fieldset>

            <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
            <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-check"></i> Disponibilizar</button>

         </form>
      </div>
   </div>

@endsection
