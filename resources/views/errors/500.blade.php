@extends('errors.base')

@section('title')
   Erro 500
@endsection

@section('content')

   <div class="row">
      <div class="error-page">
         <h2 class="headline text-red">500</h2>
         <br />
         <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Erro Interno do Servidor</h3>

            <p>
               Ocorreu algum problema durante o acesso aos servidores utilizados pelo Sistema.
               Por favor, volte mais tarde.
            </p>

         </div>
      </div>
   </div>

@endsection
