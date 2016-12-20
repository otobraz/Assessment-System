@extends('layout.professor.base')

@section('title')
   {{$section->disciplina->disciplina}}
@endsection

{{-- @section('content-header')
   <h1>{{$section->disciplina->cod_disciplina . " - " . $section->disciplina->disciplina}}</h1>
   <hr class="hr-ufop">
@endsection --}}

@section('content')


   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">{{$section->disciplina->cod_disciplina . " - " . $section->disciplina->disciplina . " - " . $section->ano . "/" . $section->semestre}}</h3>
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">


         <table class="table table-ufop table-striped table-responsive">

            <thead>
               <tr>
                  <th>Nome</th>
                  <th>Matrícula</th>
                  <th>CPF</th>
                  <th>E-mail</th>
                  <th>Curso</th>
               </tr>
            </thead>

            <tbody>
               @foreach($students as $student)
                  <tr>
                     <td>{{$student->nome_completo}}</td>
                     <td>{{$student->matricula}}</td>
                     <td>{{$student->usuario}}</td>
                     <td>{{$student->email}}</td>
                     <td>{{$student->curso->curso}}</td>
                  </tr>
               @endforeach

            </tbody>

         </table>

      </div><!-- /.box-body -->
   </div><!-- /.box -->

@endsection
