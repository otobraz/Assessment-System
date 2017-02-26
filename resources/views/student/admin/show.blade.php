@extends('layout.admin.base')

@section('title')
   Aluno | Detalhes
@endsection

@section('content')

   {{-- QUESTIONÁRIOS ABERTOS --}}

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">Questionários não Respondidos</h3>
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">

         @if($generalSurveys->count() > 0)

            <table class="table table-bordered table-col-condensed table-striped table-responsive">

               <thead>
                  <tr>
                     <th colspan="5" class="text-center">Questionários Gerais</th>
                  </tr>
                  <tr>
                     <th>Questionário</th>
                     <th>Turma</th>
                     <th>Disciplina</th>
                     <th>Disponibilização</th>
                     <th>Detalhes</th>
                  </tr>
               </thead>

               <tbody>

                  @foreach ($generalSurveys as $survey)
                     <tr>
                        <td>
                           {{$survey[0]->titulo}}
                        </td>
                        <td align="center">{{$survey[1]->cod_turma}}</td>
                        <td>{{$survey[1]->disciplina->cod_disciplina . " - " . $survey[1]->disciplina->disciplina}}</td>
                        <td align="center">{{date("d/m/y", strtotime($survey[0]->pivot->created_at))}}</td>
                        <td align="center">
                           <a class="btn btn-info btn-xs" role="button"
                           style="color: white" href="{{action('SurveyController@show', encrypt($survey[0]->id))}}">Detalhes</a>
                        </td>
                     </tr>
                  @endforeach

               </tbody>

            </table>

         @endif

         @if($openSurveys->count() > 0)

            <table class="table table-bordered table-col-condensed table-striped table-responsive">

               <thead>
                  <tr>
                     <th colspan="6" class="text-center">Questionários de Professores</th>
                  </tr>
                  <tr>
                     <th>Questionário</th>
                     <th>Turma</th>
                     <th>Disciplina</th>
                     <th>Professor</th>
                     <th>Disponibilização</th>
                     <th>Detalhes</th>
                  </tr>
               </thead>

               <tbody>

                  @foreach ($openSurveys as $survey)
                     <tr>
                        <td>
                           {{$survey[0]->titulo}}
                        </td>
                        <td align="center">{{$survey[1]->cod_turma}}</td>
                        <td>{{$survey[1]->disciplina->cod_disciplina . " - " . $survey[1]->disciplina->disciplina}}</td>
                        <td>{{$survey[0]->professor->nome_completo}}</td>
                        <td align="center">{{date("d/m/y", strtotime($survey[0]->pivot->created_at))}}</td>
                        <td align="center">
                           <a class="btn btn-info btn-xs" role="button"
                           style="color: white" href="{{action('SurveyController@show', encrypt($survey[0]->id))}}">Detalhes</a>
                        </td>
                     </tr>
                  @endforeach

               </tbody>

            </table>
         @endif
      </div><!-- /.box-body -->
   </div>

   {{-- TURMAS ATUAIS --}}

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">Turmas - {{$currentSections[0]->ano . "/" . $currentSections[0]->semestre}}</h3>
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body">
         <table class="table table-ufop table-bordered table-col-condensed table-striped table-responsive">

            <thead>
               <tr>
                  <th>Turma</th>
                  <th>Cod. Disciplina</th>
                  <th>Disciplina</th>
                  <th>Professor</th>
                  <th>Departamento</th>
                  <th>Detalhes</th>
               </tr>
            </thead>

            <tbody>
               @foreach($currentSections as $section)

                  <tr>
                     <td align="center" rowspan="{{$section->professores->count()}}">{{$section->cod_turma}}</td>
                     <td align="center" rowspan="{{$section->professores->count()}}">
                        {{$section->disciplina->cod_disciplina}}
                     </td>
                     <td rowspan="{{$section->professores->count()}}">{{$section->disciplina->disciplina}}</td>
                     <td>{{$section->professores[0]->nome_completo}}</td>
                     <td align="center" rowspan="{{count($section->professores)}}">
                        {{$section->disciplina->departamento->cod_departamento}}
                     </td>
                     <td rowspan="{{$section->professores->count()}}" align="center">
                        <a class="btn btn-info btn-xs" role="button" style="color: white" href="{{route('section.show', encrypt($section->id))}}">
                           Detalhes
                        </a>
                     </td>
                  </tr>
                  @if ($section->professores->count() > 0)
                     @foreach ($section->professores->slice(1) as $professor)
                        <tr>
                           <td>{{$professor->nome_completo}}</td>
                        </tr>
                     @endforeach
                  @endif

               @endforeach
            </tbody>

         </table>
      </div><!-- /.box-body -->
   </div><!-- /.box -->

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">Orientações em Andamento</h3>
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">

         <table class="table table-ufop table-col-condensed table-bordered table-striped table-responsive">

            <thead>
               <tr>
                  <th>Tipo</th>
                  <th>Orientador</th>
                  <th>Detalhes</th>
               </tr>

            </thead>

            <tbody>

               @foreach($currentGuidances as $guidance)
                  <tr>
                     <td>{{$guidance->tipo->tipo}}</td>
                     <td>{{$guidance->professor->nome_completo}}</td>
                     <td align="center">
                        <a class="btn btn-info btn-xs" role="button" href="{{route('guidance.show', encrypt($guidance->id))}}"> Detalhes</a>
                     </td>
                  </tr>
               @endforeach

            </tbody>
         </table>
      </div>
   </div>

@endsection
