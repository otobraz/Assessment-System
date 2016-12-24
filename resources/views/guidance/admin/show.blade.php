@extends('layout.admin.base')

@section('title')
   Orientação | Detalhes
@endsection

{{-- @section('content-header')
<h1>Perfil</h1>
<hr class="hr-ufop">
@endsection --}}

@section('content')

   <div class="col-md-offset-3 col-md-6">
      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">{{$guidance->tipo->tipo}}</h3>
            <div class="box-tools pull-right">
               <a class="btn btn-primary-ufop btn-sm" role="button"
               style="color: white" href="{{action('GuidanceController@showResponse', encrypt($guidance->id))}}">Ver resposta</a>
            </div><!-- /.box-tools -->
         </div><!-- /.box-header -->

         <div class="box-body">

            <p><b>Orientando:</b> {{$guidance->aluno->nomeCompleto}}</p>
            <p><b>Orientador:</b> {{$guidance->professor->nomeCompleto}}</p>

            <p><b>Status:  </b> {{$guidance->status ? 'Em andamento' : 'Finalizada'}}</p>

            <div class="panel panel-default">
               <div class="panel-body">
                  {{$guidance->descricao}}
               </div>
            </div>

         </div>
      </div>
   </div>

@endsection
