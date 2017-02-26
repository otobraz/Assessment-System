<table class="table table-ufop table-col-condensed table-bordered table-striped table-responsive">
   <thead>
      <tr>
         <th>Tipo</th>
         <th>Título</th>
         <th>Orientando</th>
         <th>Orientador</th>
         <th>Status</th>
         {{-- <th>Início</th> --}}
         <th>Detalhes</th>
         {{-- <th>Questionário</th> --}}
      </tr>

   </thead>

   <tbody>
      @foreach($guidances as $guidance)
         <tr>
            <td>{{$guidance->tipo->tipo}}</td>
            <td>{{$guidance->titulo}}</td>
            <td>{{$guidance->aluno->nome_completo}}</td>
            <td>{{$guidance->professor->nome_completo}}</td>
            <td>
               @if ($guidance->status)
                  Em Andamento
               @else
                  Finalizada
               @endif
            </td>
            {{-- <td>{{date("d/m/y", strtotime($guidance->created_at))}}</td> --}}
            <td align="center">
               <a class="btn btn-info btn-xs" role="button" href="{{route('guidance.show', encrypt($guidance->id))}}"> Detalhes</a>
            </td>
            {{-- <td align="center">
               @if ($guidance->questionario_liberado)
                  <a class="btn btn-primary-ufop btn-xs" role="button" href="#">Responder</a>
               @else
                  <a class="btn btn-warning btn-xs" role="button" href="#" disabled>Insdisponível</a>
               @endif
            </td> --}}
         </tr>
      @endforeach
   </tbody>
</table>
