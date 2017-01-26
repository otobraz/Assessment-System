@extends('errors.base')

@section('title')
   Erro 401
@endsection

@section('content')

   <div class="row">
      <div class="error-page">
         <h2 class="headline text-red">401</h2>
         <br />
         <div class="error-content">
            <h3><i class="fa fa-hand-stop-o text-red"></i> Acesso não permitido!</h3>

            <p>
               Você não possui permissão para acessar esta página.
               Voltar à página <a href="{{url('/')}}">inicial</a> ou à página <a href="javascript:history.back()">anterior.</a>
            </p>
         </div>
      </div>
   </div>

@endsection
