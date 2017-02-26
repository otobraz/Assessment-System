@extends('layout.student.base')

@section('title')
   {{$section->disciplina->disciplina}}
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">{{$section->disciplina->cod_disciplina . " - " . $section->disciplina->disciplina}}</h3>
         @foreach ($section->professores as $professor)
            <br>
            <h3 class="box-title"><small>{{$professor->nome_completo . " - " . $professor->email}}</small></h3>
         @endforeach
      </div><!-- /.box-header -->
      <div class="box-body">
         @include('alert-message.success')
         @include('alert-message.error')

         <table id="show-table" class="table table-striped table-bordered table-responsive">
            <thead>
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

@endsection

@section('myScripts')

@endsection
