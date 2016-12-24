<table class="table table-ufop table-col-condensed table-striped table-responsive">
   <thead>
      <tr>
         <th>Tipo</th>
         <th>Orientando</th>
         <th>Orientador</th>
         <th>Status</th>
         <th>Detalhes</th>
         <th>Questionário</th>
      </tr>

   </thead>

   <tbody>
      @foreach($guidances as $guidance)
         <tr>
            <td>{{$guidance->tipo->tipo}}</td>
            <td>{{$guidance->aluno->nomeCompleto}}</td>
            <td>{{$guidance->professor->nomeCompleto}}</td>
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
               @if ($guidance->questionario_liberado)
                  <a class="btn btn-primary-ufop btn-xs" role="button" href="#">Responder</a>
               @else
                  <a class="btn btn-success btn-xs" role="button" href="#" disabled><span class="glyphicon glyphicon-ok" aria-hidden="true">Insdisponível</a>
               @endif
            </td>
         </tr>
      @endforeach
   </tbody>
</table>
