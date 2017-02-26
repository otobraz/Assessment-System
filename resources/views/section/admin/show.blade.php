@extends('layout.admin.base')

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
                        style="color: white" href="{{action('SurveyController@generalSurveyShow', encrypt($survey->id))}}">Detalhes</a>
                     </td>
                  </tr>
               @endforeach
            </tbody>

         </table>

      </div><!-- /.box-body -->
   </div><!-- /.box -->

@endsection

@section('myScripts')

@endsection
