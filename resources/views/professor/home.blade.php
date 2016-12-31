@extends('layout.professor.base')

@section('title')
   Professor | Home
@endsection

@section('content-header')
   <h1>{{session()->get('first_name')}}, <small>seja bem-vindo(a)!</small></h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   {{-- TURMAS ATUAIS --}}

   <div class="row">

      <div class="col-md-6">

         <div class="box box-primary-ufop collapsed-box">
            <div class="box-header with-border">
               <h3 class="box-title">Minhas Turmas</h3>
               <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
               <table class="table table-ufop table-bordered table-col-condensed table-striped table-responsive">

                  <thead>
                     <tr>
                        <th>Turma</th>
                        <th>Cod. Disciplina</th>
                        <th>Disciplina</th>
                        <th>Detalhes</th>
                     </tr>
                  </thead>


                  <tbody>
                     @foreach($currentSections as $section)
                        <tr>
                           <td align="center">{{$section->cod_turma}}</td>
                           <td align="center">{{$section->disciplina->cod_disciplina}}</td>
                           <td>{{$section->disciplina->disciplina}}</td>
                           <td align="center"><a class="btn btn-info btn-xs" role="button"
                              style="color: white" href="{{route('section.show', encrypt($section->id))}}">Detalhes</a>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>

               </table>
            </div><!-- /.box-body -->
         </div><!-- /.box -->

      </div>

      <div class="col-md-6">

         <div class="box box-primary-ufop collapsed-box">
            <div class="box-header with-border">
               <h3 class="box-title">Orientações em Andamento</h3>
               <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               </div><!-- /.box-tools -->
            </div><!-- /.box-header -->

            <div class="box-body">

               <table class="table table-ufop table-col-condensed table-bordered table-striped table-responsive">

                  <thead>
                     <tr>
                        <th>Tipo</th>
                        <th>Orientando</th>
                        <th>Detalhes</th>
                     </tr>

                  </thead>

                  <tbody>

                     @foreach($currentGuidances as $guidance)
                        <tr>
                           <td>{{$guidance->tipo->tipo}}</td>
                           <td>{{$guidance->aluno->nome_completo}}</td>
                           <td align="center">
                              <a class="btn btn-info btn-xs" role="button" href="{{route('guidance.show', encrypt($guidance->id))}}"> Detalhes</a>
                           </td>
                        </tr>
                     @endforeach

                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

   <hr class="hr-ufop">

   {{-- QUESTIONÁRIOS ABERTOS --}}

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">Questionários Abertos</h3>
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">

         <table class="table table-bordered table-col-condensed table-striped table-responsive">

            <thead>
               <tr>
                  <th>Questionário</th>
                  <th>Turma</th>
                  <th>Cod. Disciplina</th>
                  <th>Disciplina</th>
                  <th>Disponibilização</th>
                  <th>N. Respostas</th>
                  <th>Resultado</th>
               </tr>
            </thead>

            <tbody>

               @foreach ($myOpenSurveys as $survey)
                  <tr>
                     <td>
                        {{$survey->titulo}}
                     </td>
                     <td align="center">{{$survey->cod_turma}}</td>
                     <td align="center">{{$survey->disciplina->cod_disciplina}}</td>
                     <td>{{$survey->disciplina->disciplina}}</td>
                     <td align="center">{{date("d/m/y", strtotime($survey->pivot->created_at))}}</td>
                     <td align="center">{{$responsesCount[$survey->pivot->id]}}</td>
                     <td align="center">
                        <a class="btn btn-info btn-xs" role="button"
                        style="color: white" href="{{route('survey.classResult', encrypt($survey->pivot->id))}}"><i class="fa fa-bar-chart"></i> Resultado</a>
                     </td>
                  </tr>
               @endforeach

            </tbody>

         </table>

      </div><!-- /.box-body -->
   </div>

@endsection
