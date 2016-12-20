@extends('layout.student.base')

@section('title')
   Professor | Detalhes
@endsection

{{-- @section('content-header')
<h1>Perfil</h1>
<hr class="hr-ufop">
@endsection --}}

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">{{$professor->nome_completo}}</h3>
         <div class="box-tools pull-right">
            <button class="btn btn-primary-ufop btn-sm" type="button" onclick="history.go(-1)"><i class="fa fa-arrow-left"></i> Voltar</button>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body">

         <h4><b>E-mail: </b>{{$professor->email}}</h4>
         <h4><b>Áreas de Interesse: </b>{{$professor->areas_interesse}}</h4>
         <h4><b>Departamento: </b>{{$professor->departamento->cod_departamento . " - " . $professor->departamento->departamento}}</h4>

      </div><!-- /.box-body -->
   </div><!-- /.box -->

   @foreach ($sectionsGroup as $year => $semesters)

      @foreach ($semesters as $semester => $sections)

         <div class="box box-primary-ufop">
            <div class="box-header with-border">
               <h3 class="box-title">TURMAS - {{$year . "/" . $semester}}</h3>
               <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
               <table class="table table-ufop table-striped table-responsive">

                  <thead>
                     <tr>
                        <th>Turma</th>
                        <th>Cod. Disciplina</th>
                        <th>Disciplina</th>
                     </tr>
                  </thead>


                  <tbody>
                     @foreach($sections as $section)
                        <tr>
                           <td>{{$section->cod_turma}}</td>
                           <td>{{$section->disciplina->cod_disciplina}}</td>
                           <td>{{$section->disciplina->disciplina}}</td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div><!-- /.box-body -->
         </div><!-- /.box -->
      @endforeach
   @endforeach

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">QUESTIONÁRIOS</h3>
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body">
         <table class="table table-hover table-ufop table-striped table-responsive">

            <thead>
               <tr>
                  <th>Título</th>
                  <th>Data de Criação</th>
                  <th>Detalhes</th>
               </tr>

            </thead>

            <tbody>
               @foreach ($surveys as $survey)
                  <tr>
                     <td>{{{$survey->titulo}}}</td>
                     <td>{{date("d/m/y", strtotime($survey->created_at))}}</td>
                     <td>
                        <a type="button" class="btn btn-primary-ufop btn-xs" href="{{route('survey.show', encrypt($survey->id))}}">Detalhes</a>
                     </td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      </div><!-- /.box-body -->
   </div><!-- /.box -->

   @if(!$guidances->isEmpty())
      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">ORIENTAÇÕES</h3>
            <div class="box-tools pull-right">
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
         </div><!-- /.box-header -->
         <div class="box-body">

            <table class="table table-ufop table-col-condensed table-striped table-responsive">

               <thead>
                  <tr>
                     <th>Tipo</th>
                     <th>Orientando</th>
                     <th>Status</th>
                     <th>Detalhes</th>
                     <th>Resposta</th>
                  </tr>
               </thead>

               <tbody>
                  @foreach($guidances->sortByDesc('id') as $guidance)
                     <tr>
                        <td>{{$guidance->tipo->tipo}}</td>
                        <td>{{$guidance->aluno->nomeCompleto}}</td>
                        <td>
                           @if ($guidance->status)
                              Em Andamento
                           @else
                              Finalizada
                           @endif
                        </td>
                        <td>
                           <a class="btn btn-info btn-xs" role="button" href="{{route('guidance.show', encrypt($guidance->id))}}"> Detalhes</a>
                        </td>
                        <td>
                           <a class="btn btn-primary-ufop btn-xs" role="button" href="{{route('guidance.show', encrypt($guidance->id))}}"> Resposta</a>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div><!-- /.box-body -->
      </div><!-- /.box -->

   @endif

@endsection
