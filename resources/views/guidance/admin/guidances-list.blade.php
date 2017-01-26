<table class="table table-ufop table-col-condensed table-striped table-bordered table-responsive">
   <thead>
      <tr>
         <th>Tipo</th>
         <th>Título</th>
         <th>Orientando</th>
         <th>Orientador</th>
         <th>Status</th>
         <th>Detalhes</th>
      </tr>

   </thead>

   <tbody>
      @foreach($guidances as $guidance)
         <tr>
            <td>{{$guidance->tipo->tipo}}</td>
            <td>{{$guidance->titulo}}</td>
            <td>{{$guidance->aluno->nomeCompleto}}</td>
            <td>{{$guidance->professor->nomeCompleto}}</td>
            <td>
               @if ($guidance->status)
                  Em Andamento
               @else
                  Finalizada
               @endif
            </td>            <td align="center">
               <a class="btn btn-info btn-xs" role="button" href="{{route('guidance.show', encrypt($guidance->id))}}"> Detalhes</a>
            </td>
         </tr>
      @endforeach
   </tbody>
</table>
