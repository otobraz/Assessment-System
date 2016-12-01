@extends('layout.admin.base')

@section('title')
   Gerenciar | Professores
@endsection

@section('extraCss')
   <link href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content-header')
   <h1>Gerenciar Professores</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="panel panel-default">
      <div class="panel-heading contains-buttons">
         <a class="btn btn-primary pull-right" role="button"
         style="color: white" href="{{route('professor.import')}}">Importar Professores</a>
         <p class="panel-title contains-buttons pull-left">Professores</p>
         <span class="clearfix"></span>
      </div>
      <div class="panel-body">
         @include('alert-message.success')
         @include('alert-message.error')
         @include('professor.admin.professors-list')
      </div>
   </div>

@endsection

@section('myScripts')

   <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

   <script>
   $(document).ready(function () {
      $("#index-table").DataTable( {
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
   </script>

   {{-- <script>
   $(document).ready(function () {
      $("#professors").DataTable( {
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
         "scrollY":        '50vh',
         "scrollCollapse": true,
         "paging":         false
      });
   });
   </script> --}}

@endsection
