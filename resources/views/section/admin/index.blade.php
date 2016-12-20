@extends('layout.admin.base')

@section('title')
   Gerenciar | Turmas
@endsection

{{-- @section('content-header')
<h1>Gerenciar Turmas</h1>
<hr class="hr-ufop">
@endsection --}}

@section('extraCss')
   <link href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">TURMAS</h3>
         <div class="box-tools pull-right">
            <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{action('SectionController@import')}}">Importar Turmas</a>
            <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{action('SectionController@importRegistrations')}}">Importar Ajustes</a>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body">
         @include('alert-message.success')
         @include('alert-message.error')
         @include('section.admin.sections-list')
      </div><!-- /.box-body -->
   </div><!-- /.box -->

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>

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
         "aLengthMenu": [[50, 100, 200, 300, -1], [50, 100, 200, 300, "Tudo"]]
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
