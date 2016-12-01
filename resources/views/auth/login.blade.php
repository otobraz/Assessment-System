@extends('auth.base')

@section('content')
   <body>
      <br>
      <div class="container">
         <div class="row">
            <div class="col-md-offset-4 col-md-4"> {{-- Define a coluna de tamanho 6 mas com offset de coluna 3 --}}
               <!-- <img src="{{asset('image/logoFull.png')}}" height="300px" width="250px" class="img-responsive center-block" alt="Logotipo"/> -->
               <form class="form-signin" method="POST" action="{{url('login')}}">

                  <fieldset>
                     {{ csrf_field() }}
                     <legend>Login no Sistema</legend>
                     @if(session('authError'))
                        <div class="form-group has-error">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                              <input class="form-control input-xlarge" type="text" maxlength="14" name="username" id="username" placeholder="CPF" autofocus required
                              oninvalid="setCustomValidity('Informe o usuário.')"
                              oninput="setCustomValidity('')"
                              >
                              {{-- onkeypress="return mask(this)" --}}
                           </div>
                           <br/>
                           <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                              <input class="form-control input-xlarge " type="password" name="password" id="password" placeholder="Senha" required
                              oninvalid="setCustomValidity('Informe a senha.')"
                              oninput="setCustomValidity('')"
                              >
                           </div>
                           <p class="help-block">{{session('authError')}}</p>
                        </div>
                     @else
                        <div class="input-group">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                           <input class="form-control input-xlarge" type="text" maxlength="14" name="username" id="username" placeholder="CPF" autofocus required
                           oninvalid="setCustomValidity('Informe o usuário.')"
                           oninput="setCustomValidity('')"
                           >
                        </div>
                        {{-- <p class="help-block">{{"Apenas números"}}</p> --}}
                        <br/>
                        <div class="input-group">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                           <input class="form-control input-xlarge " type="password" name="password" id="password" placeholder="Senha" required
                           oninvalid="setCustomValidity('Informe a senha.')"
                           oninput="setCustomValidity('')"
                           >
                        </div>
                     @endif
                     <br/>
                     <p class="text-center">
                        <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-sign-in"></i> Entrar</button>
                        <p>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
            <hr>
         </body>
      @endsection
