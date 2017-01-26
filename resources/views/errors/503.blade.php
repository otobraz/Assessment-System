@extends('errors.base')

@section('title')
   Erro 503
@endsection

@section('content')

   <div class="row">
      <div class="error-page">
         <h2 class="headline text-yellow">503</h2>
         <br />
         <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Sistema indisponível</h3>

            <p>
               O acesso ao sistema está indisponível no momento. Por favor, volte mais tarde.
            </p>

         </div>
      </div>
   </div>

@endsection
