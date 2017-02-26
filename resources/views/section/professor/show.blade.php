@extends('layout.professor.base')

@section('title')
   {{$section->disciplina->disciplina}}
@endsection

@section('content')

   {{-- ALUNOS --}}

   <div class="box box-primary-ufop collapsed-box">
      <div class="box-header with-border">
         <h3 class="box-title">{{$section->disciplina->cod_disciplina . " - " . $section->disciplina->disciplina}}</h3>
         @foreach ($section->professores as $professor)
            <br>
            <h3 class="box-title"><small>{{$professor->nome_completo . " - " . $professor->email}}</small></h3>
         @endforeach
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body">
         @include('alert-message.success')
         @include('alert-message.error')

         <table id="show-table" class="table table-striped table-bordered table-responsive">
            <thead>
               <tr>
                  <th colspan="3" class="text-center">Alunos</th>
               </tr>
               <tr>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Curso</th>
               </tr>
            </thead>
            <tbody>
               @foreach($students as $student)
                  <tr>
                     <td>{{$student->nome . " " . $student->sobrenome}}</td>
                     <td>{{$student->email}}</td>
                     <td>{{$student->curso->curso}}</td>
                  </tr>
               @endforeach
            </tbody>
            <tfoot>
               <tr>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Curso</th>
               </tr>
            </tfoot>
         </table>

      </div><!-- /.box-body -->
   </div><!-- /.box -->

   {{-- QUESTIONÁRIOS --}}

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">Questionários</h3>

         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body">

         @include('alert-message.success')
         @include('alert-message.error')

         <table id="index-table" class="table table-ufop table-col-condensed table-bordered table-striped table-responsive">

            <thead>
               <tr>
                  <th>Id</th>
                  <th>Título</th>
                  <th>Detalhes</th>
               </tr>
            </thead>

            <tbody>
               @foreach($surveys as $survey)
                  <tr>
                     <td align="center">{{$survey->id}}</td>
                     <td>{{$survey->titulo}}</td>
                     <td align="center">
                        <a class="btn btn-info btn-xs" role="button"
                        style="color: white" href="{{action('SurveyController@show', encrypt($survey->id))}}">Detalhes</a>
                     </td>
                  </tr>
               @endforeach
            </tbody>

         </table>

      </div><!-- /.box-body -->
   </div><!-- /.box -->

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">DISPONIBILIZAÇÕES</h3>
         <div class="box-tools pull-right">
            <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{action('SurveyController@overallResult', encrypt($survey->id))}}"><i class="fa fa-bar-chart"></i> Resultado Geral</a>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">

         <form class="form-signin" method="POST" autocomplete="off" action="{{action('SurveyController@comparedResult')}}">

            <fieldset>

               {{ csrf_field() }}

               <input type="hidden" name="surveyId" value="{{$survey->id}}">

               <table class="table table-bordered table-hover table-col-condensed clickable-row table-striped table-responsive">

                  <thead>
                     <tr>
                        <th colspan="8" class="text-center">TURMAS</th>
                     </tr>
                     <tr>
                        <th>Disciplina (selecione para comparar)</th>
                        <th>Turma</th>
                        <th>Departamento</th>
                        <th>Semestre</th>
                        <th>Disponibilização</th>
                        <th>Status</th>
                        {{-- <th>No. Respostas</th> --}}
                        <th>Respostas</th>
                        <th>Resultado</th>
                     </tr>
                  </thead>

                  <tbody>

                     <div class="form-group">

                        @foreach ($survey->turmas()->OrderByDisciplina()->get() as $section)
                           <tr>
                              <td>
                                 <input type="checkbox" name="sections[]" id="{{$section->id}}" value="{{$section->id}}">
                                 {{"  " . $section->disciplina->disciplina}}
                              </td>
                              <td align="center">{{$section->cod_turma}}</td>
                              <td align="center">{{$section->disciplina->departamento->cod_departamento}}</td>
                              <td>{{$section->ano . "/" . $section->semestre}}</td>
                              <td>
                                 {{date("d/m/y", strtotime($section->pivot->created_at))}}
                              </td>
                              <td>
                                 @if($section->pivot->aberto)
                                    Aberto
                                 @else
                                    Fechado
                                 @endif
                              </td>
                              <td align="center"><a class="btn btn-primary btn-xs" role="button"
                                 style="color: white" href="{{route('survey.showResponses', encrypt($section->pivot->id))}}">Respostas</a>
                              </td>
                              <td align="center"><a class="btn btn-info btn-xs" role="button"
                                 style="color: white" href="{{route('survey.classResult', encrypt($section->pivot->id))}}"><i class="fa fa-bar-chart"></i> Resultado</a>
                              </td>
                           </tr>
                        @endforeach

                     </div>

                  </tbody>

                  <tfoot>
                     <tr>
                        @if ($survey->turmas()->OrderByDisciplina()->get()->count() >= 1)
                           <td colspan="8"><button class="btn btn-primary-ufop" type="submit"><span class="glyphicon glyphicon-stats" aria-label="Comparar"></span> Comparar</button></td>
                        @else
                           <td colspan="8"><button disabled class="btn btn-primary-ufop" type="submit"><span class="glyphicon glyphicon-stats" aria-label="Comparar"></span> Comparar</button></td>
                        @endif
                     </tr>
                  </tfoot>
               </table>

            </fieldset>

         </form>

      </div><!-- /.box-body -->
   </div><!-- /.box -->

@endsection

@section('myScripts')

@endsection
