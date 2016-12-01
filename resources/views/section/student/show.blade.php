@extends('layout.student.base')

@section('title')
   {{$section->disciplina->disciplina}}
@endsection

@section('extraCss')
   <link href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content-header')
   {{-- <h1>{{$section->disciplina->cod_disciplina . " - " . $section->disciplina->disciplina}}</h1>
   <hr class="hr-ufop"> --}}
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">{{$section->disciplina->cod_disciplina . " - " . $section->disciplina->disciplina}}</h3>
         @foreach ($section->professores as $professor)
            <br>
            <h3 class="box-title"><small>{{$professor->nome_completo . " - " . $professor->email}}</small></h3>
         @endforeach
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
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

   {{-- <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

   <script>

   $(document).ready(function () {

      $("#show-table").DataTable( {
         "language": {
            "lengthMenu": "Mostrar  _MENU_  registros por página",
            "zeroRecords": "Nada encontrado.",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(Filtrado de _MAX_ registros)",
            "search": "Procurar: ",
            "paginate": {
               "next": "Próximo",
               "previous": "Anterior"
            }
         },
         "autoWidth": true,
         "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tudo"]]
      });
   });

   </script> --}}

@endsection
