@extends('layout.admin.base')

@section('title')
   Cadastrar Administrador
@endsection

@section('content-header')
   <h1>
      Cadastrar Administrador
   </h1>
   <hr>
@endsection

@section('content')

   <div class="col-md-offset-3 col-md-6">
      <div class="panel panel-default">
         <div class="panel-body">
            <form class="form-signin" method="POST" autocomplete="off" action="{{action('AdminController@store')}}">
               {{ csrf_field() }}
               <fieldset>

                  <!-- fake fields are a workaround for chrome autofill getting the wrong fields -->
                  <input style="display:none" type="text" name="fakeusernameremembered"/>
                  <input style="display:none" type="password" name="fakepasswordremembered"/>

                  <div class="form-group">
                     <label for="first_name">Nome:</label>
                     <input class="form-control input-xlarge" type="text"
                     name="first_name" id="first_name"
                     autofocus required
                     oninvalid="setCustomValidity('Informe o seu nome.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <div class="form-group">
                     <label for="last_name">Sobrenome:</label>
                     <input class="form-control input-xlarge " type="text"
                     name="last_name" id="last_name" required
                     oninvalid="setCustomValidity('Informe o seu sobrenome.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <div class="form-group">
                     <label for="email">E-mail:</label>
                     <input class="form-control input-xlarge" type="email"
                     name="email" id="email" required
                     oninvalid="setCustomValidity('Informe o seu e-mail.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <div class="form-group">
                     <label for="username">Usuário:</label>
                     <input class="form-control input-xlarge" type="text"
                     name="username" id="username" required
                     oninvalid="setCustomValidity('Informe o nome de usuário.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <div class="form-group">
                     <label for="password">Senha:</label>
                     <input class="form-control input-xlarge"
                     type="password" name="password"
                     id="password" required
                     oninvalid="setCustomValidity('Informe a sua senha.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                  <button class="btn btn-primary" type="submit"><i class="fa fa-check-square-o"></i> Criar</button>
               </fieldset>
            </form>
         </div>
      </div>
   </div>
@endsection
