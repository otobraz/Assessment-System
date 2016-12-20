@extends('layout.student.base')

@section('title')
   Questionário | Detalhes
@endsection

{{-- @section('content-header')
<h1>Meus Questionários</h1>
<hr class="hr-ufop">
@endsection --}}

@section('content')

   @include('alert-message.success')
   @include('alert-message.error')

   <form class="form-signin" method="POST" autocomplete="off" action="{{action('SurveyController@postResults')}}">
      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">{{$survey->titulo . " - " . date("d/m/y - H:i:s", strtotime($survey->created_at))}}</h3>
            <div class="box-tools pull-right">
               <a class="btn btn-primary-ufop btn-sm" role="button"
               style="color: white" href="{{action('SurveyController@getResults', encrypt($survey->id))}}"><i class="fa fa-bar-chart"></i> Resultado Geral</a>
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
         </div><!-- /.box-header -->

         <div class="box-body">

            <fieldset>

               {{ csrf_field() }}

               <input type="hidden" name="surveyId" value="{{$survey->id}}">

               <table class="table table-bordered table-hover table-col-condensed table-striped table-responsive">

                  <thead>
                     <tr>
                        <th colspan="8" class="text-center">TURMAS</th>
                     </tr>
                     <tr>
                        <th>Comparar Respostas</th>
                        <th>Disciplina</th>
                        <th>Código da Turma</th>
                        <th>Departamento</th>
                        <th>Semestre</th>
                        <th>Data de Atribuição</th>
                        <th>Status</th>
                        <th>Respostas das Turmas</th>
                     </tr>
                  </thead>

                  <tbody>

                     <div class="form-group">

                        @foreach ($survey->turmas as $section)
                           <tr>
                              <td>
                                 <input type="checkbox" name="sections[]" value="{{$section->id}}">
                              </td>
                              <td>{{$section->disciplina->disciplina}}</td>
                              <td>{{$section->cod_turma}}</td>
                              <td>{{$section->disciplina->departamento->cod_departamento}}</td>
                              <td>{{$section->ano . "/" . $section->semestre}}</td>
                              <td>
                                 {{date("d/m/y - H:i:s", strtotime($section->pivot->created_at))}}
                              </td>
                              <td>
                                 @if($section->pivot->aberto)
                                    Aberto
                                 @else
                                    Fechado
                                 @endif
                              </td>
                              <td><a class="btn btn-primary-ufop btn-xs" role="button"
                                 style="color: white" href="{{route('survey.classResults', [encrypt($survey->id), encrypt($section->id)])}}"><i class="fa fa-bar-chart"></i> Resultado</a>
                              </td>
                           </tr>
                        @endforeach

                     </div>

                     <tr>
                        <td colspan="8"><button class="btn btn-primary-ufop" type="submit"><span class="glyphicon glyphicon-stats" aria-label="Comparar"></span> Comparar</button></td>
                     </tr>

                  </tbody>

               </table>

            </fieldset>

         </form>

      </div><!-- /.box-body -->
   </div><!-- /.box -->

@endsection

@section('myScripts')

@endsection
