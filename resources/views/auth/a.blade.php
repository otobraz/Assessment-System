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

                  <div class="col-lg-9">
                     <p class="help-block">{{session('authError')}}</p>
                  </div>
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
               <button type="submit" class="btn btn-primary">Entrar</button>
               <button type="reset" class="btn btn-default">Limpar</button>
            </div>
         </fildset>
      </form>

   </div>
@endsection
