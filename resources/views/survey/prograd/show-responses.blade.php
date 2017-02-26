@extends('layout.prograd.base')

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">RESPOSTAS</h3>
      </div><!-- /.box-header -->

      <div class="box-body">
         @include('alert-message.success')
         @include('alert-message.error')

         <table class="table table-ufop table-striped table-bordered table-col-condensed table-responsive">

            <thead>
               <tr>
                  <th>Id</th>
                  <th>Aluno</th>
                  <th>Questionário</th>
                  <th>Data Respondida</th>
                  <th>Detalhes</th>
               </tr>
            </thead>


            <tbody>
               @foreach($responses as $response)
                  <tr>
                     <td align="center">{{$response->id}}</td>
                     <td>{{$response->aluno->nomeCompleto}}</td>
                     <td>{{$response->questionario->titulo}}</td>
                     <td align="center">{{date("d/m/y - H:i:s", strtotime($response->created_at))}}</td>
                     <td align="center">
                        <a role="button" class="btn btn-info btn-xs" href="{{route('response.show', encrypt($response->id))}}"></i>Detalhes</a>
                     </td>
                  </tr>
               @endforeach
            </tbody>

         </table>

      </div>
   </div>

@endsection
