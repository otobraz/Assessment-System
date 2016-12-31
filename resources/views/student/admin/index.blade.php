@extends('layout.admin.base')

@section('title')
   Gerenciar | Alunos
@endsection

@section('extraCss')
   <link href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">ALUNOS</h3>
         <div class="box-tools pull-right">
            <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{route('student.import')}}">Importar Alunos</a>
            </button>
         </div>
      </div>
      <div class="box-body">
         @include('alert-message.success')
         @include('alert-message.error')
         @include('student.admin.students-list')
      </div><!-- /.box-body -->
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
         "order": [],
         "autoWidth": true,
         "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tudo"]],
         "columnDefs": [{
            "orderable": false,
            "targets": [6]
         }]
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
