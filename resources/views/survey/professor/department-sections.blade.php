@extends('layout.professor.base')

@section('title')
   {{$survey->titulo}}
@endsection

@section('extraCss')
   <link href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">{{$department->departamento . " - " . $year . "/" . $semester}}</h3>
         <div class="box-tools pull-right">
            <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{action('SurveyController@overallResult', encrypt($survey->id))}}"><i class="fa fa-bar-chart"></i> Resultado Geral</a>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">

         <form class="form-signin" method="POST" autocomplete="off" action="{{action('SurveyController@comparedResult')}}">

            <fieldset>

               {{ csrf_field() }}

               <input type="hidden" name="surveyId" value="{{$survey->id}}">

               <table id="index-table" class="table table-bordered table-hover table-col-condensed clickable-row table-striped table-responsive">

                  <thead>
                     <tr>
                        <th colspan="8" class="text-center">TURMAS</th>
                     </tr>
                     <tr>
                        <th>Disciplina (selecione para comparar)</th>
                        <th>Código da Disciplina</th>
                        <th>Turma</th>
                        <th>Professor</th>
                        <th>No. Respostas</th>
                        <th>Resultado</th>
                     </tr>
                  </thead>

                  <tbody>

                     <div class="form-group">

                        @foreach ($sections as $section)

                           <tr>
                              <td>
                                 <input type="checkbox" name="sections[]" id="{{$section->id}}" value="{{$section->id}}">
                                 {{"  " . $section->disciplina->disciplina}}
                              </td>
                              <td>
                                 {{$section->disciplina->cod_disciplina}}
                              </td>
                              <td align="center">{{$section->cod_turma}}</td>
                              @if ($section->professores->count() > 1)
                                 <td>{{$section->professores[0]->nome_completo . " / " .  $section->professores[1]->nome_completo}}</td>
                              @else
                                 <td>{{$section->professores[0]->nome_completo}}</td>
                              @endif

                              <td align="center">{{$responsesCount[$section->pivot->id]}}</td>
                              <td align="center"><a class="btn btn-info btn-xs" role="button"
                                 style="color: white" href="{{route('survey.classResult', encrypt($section->pivot->id))}}"><i class="fa fa-bar-chart"></i> Resultado</a>
                              </td>
                           </tr>

                        @endforeach

                     </div>

                  </tbody>

                  <tfoot>
                     <tr>
                        @if ($sections->count() > 0)
                           <td colspan="5"><button class="btn btn-primary-ufop" type="submit"><span class="glyphicon glyphicon-stats" aria-label="Comparar"></span> Comparar</button></td>
                        @else
                           <td colspan="5"><button disabled class="btn btn-primary-ufop" type="submit"><span class="glyphicon glyphicon-stats" aria-label="Comparar"></span> Comparar</button></td>
                        @endif
                     </tr>
                  </tfoot>
               </table>

            </fieldset>

         </form>

      </div><!-- /.box-body -->
   </div><!-- /.box -->

@endsection

@section('myScripts')

   <script src="{{asset('/js/clickableRow.js')}}"></script>

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
         "order": [[0, "asc"]],
         "autoWidth": true,
         "aLengthMenu": [[25, 50, -1], [25, 50, "Tudo"]],
         "columnDefs": [{
            "orderable": false,
            "targets": 5
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
