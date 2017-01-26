<table class="table table-ufop table-col-condensed table-bordered table-striped table-responsive">
   <thead>
      <tr>
         <th>Tipo</th>
         <th>Título</th>
         <th>Orientando</th>
         <th>Status</th>
         <th>Encerrar / Recomeçar</th>
         <th>Questionário</th>
         <th>Detalhes</th>
      </tr>

   </thead>

   <tbody>
      @foreach($guidances as $guidance)
         <tr>
            <td>{{$guidance->tipo->tipo}}</td>
            <td>{{$guidance->titulo}}</td>
            <td>{{$guidance->aluno->nome_completo}}</td>
            <td>
               @if ($guidance->status)
                  Em Andamento
               @else
                  Finalizada
               @endif

            </td>
            <td align="center">
               @if ($guidance->status)
                  <a class="btn btn-warning btn-xs" role="button" href="{{route('guidance.finish', encrypt($guidance->id))}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Encerrar</a>
               @else
                  <a class="btn btn-success btn-xs" role="button" href="{{route('guidance.restart', encrypt($guidance->id))}}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Recomeçar</a>
               @endif
            </td>
            <td align="center">
               @if ($guidance->questionario_liberado)
                  <a class="btn btn-warning btn-xs" role="button" href="{{route('guidance.cancelSurvey', encrypt($guidance->id))}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Indisponibilizar</a>
               @else
                  <a class="btn btn-success btn-xs" role="button" href="{{route('guidance.provideSurvey', encrypt($guidance->id))}}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Disponilizar</a>
               @endif
            </td>

            <td align="center">
               <a class="btn btn-info btn-xs" role="button" href="{{route('guidance.show', encrypt($guidance->id))}}"> Detalhes</a>
            </td>
         </tr>
      @endforeach
   </tbody>
</table>
