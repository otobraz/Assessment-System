@extends('auth.base')

@section('content')

   <div class="login-box">
      <div class="login-logo">
         <i class="fa fa-bar-chart"></i>
         <b>Sis</b>tema de <b>Av</b>aliação de classes e orientações
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body ufop-border">
         <p class="login-box-msg">Faça o login para utilizar o sistema</p>

         <form method="POST" action="{{url('login')}}">

            {{ csrf_field() }}
            <fildset>

               @if(session('authError'))
                  <div class="has-error">
                     <div class="form-group has-feedback">
                        <input class="form-control" type="text" name="username" id="username" placeholder="CPF (somente números)" autofocus required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                     </div>
                     <div class="form-group has-feedback">
                        <input class="form-control input-xlarge " type="password" name="password" id="password" placeholder="Senha" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                     </div>
                     <p class="help-block">{{session('authError')}}</p>
                  </div>
               @else
                  <div class="form-group has-feedback">
                     <input class="form-control" type="text" name="username" id="username" placeholder="CPF (somente números)" autofocus required>
                     <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                     <input class="form-control input-xlarge " type="password" name="password" id="password" placeholder="Senha" required>
                     <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
               @endif

               <div class="row">
                  <div class="col-md-6">
                     <button class="btn btn-flat btn-block btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                  </div>
                  <div class="col-md-6">
                     <button class="btn btn-flat btn-block btn-primary-ufop" type="submit"><i class="fa fa-sign-in"></i> Entrar</button>
                  </div>
               </div>

               <hr>

               <p class="text-center">
                  Use o <span class="text-bold">mesmo CPF</span> e a <span class="text-bold">mesma SENHA</span><br> do <a href="http://www.minha.ufop.br/" target="_blank"><i class="fa fa-home"></i>Minha UFOP</a>
               </p>

            </form>
         </fieldset>
      </div><!-- /.login-box-body -->
   </div><!-- /.login-box -->


@endsection
