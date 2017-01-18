@extends('templates.pagesTemplate')

@section('content')
   <div class="col-lg-12">
      <img class="img-responsive col-lg-6" src="{{asset('img/logoNTI.jpeg')}}" alt="System's Logo">
      <form class="form-horizontal col-lg-6" method="POST" action="{{url('login')}}">
         {{ csrf_field() }}
         <fildset>
            <legend>Login no Sistema</legend>

            @if(session('authError'))
               <div class="form-group has-error">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input class="form-control input-xlarge" type="text" name="username" id="username" placeholder="CPF" autofocus>
                     </div>
                     <br/>

                     <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input class="form-control input-xlarge " type="password" name="password" id="password" placeholder="Senha">
                     </div>


                     <p class="help-block">{{session('authError')}}</p>

               </div>
            @else
               <div class="col-lg-9">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input class="form-control input-xlarge" type="text" name="username" id="username" placeholder="CPF" autofocus>
                  </div>
                  <br/>
               </div>
               <div class="col-lg-9">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                     <input class="form-control input-xlarge " type="password" name="password" id="password" placeholder="Senha">
                  </div>
               </div>
            @endif

            <div class="col-lg-9">
               <br/>
               <button type="submit" class="btn btn-primary-ufop">Entrar</button>
               <button type="reset" class="btn btn-default">Limpar</button>
            </div>
         </fildset>
      </form>

   </div>
@endsection

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
               <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-sign-in"></i> Entrar</button>
               <p>
               </fieldset>
            </form>
         </div>
      </div>
   </div>
   <hr>
