@extends('layout.admin.base')

@section('title')
   Administrador | Cadastrar
@endsection

@section('content')

   <div class="col-md-offset-3 col-md-6">
      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">CADASTRAR ADMINISTRADOR</h3>
         </div>

         <div class="box-body">

            @include('alert-message.error')

            <form class="form-signin" method="POST" autocomplete="off" action="{{action('AdminController@store')}}">

               {{ csrf_field() }}
               <fieldset>

                  <!-- fake fields are a workaround for chrome autofill getting the wrong fields -->
                  <input style="display:none" type="text" name="fakeusernameremembered"/>
                  <input style="display:none" type="password" name="fakepasswordremembered"/>

                  <div class="form-group">
                     <label for="first-name">Nome: <span class="span-error">*</span></label>
                     <input class="form-control input-xlarge" type="text"
                     name="first-name" id="first-name"
                     autofocus required
                     oninvalid="setCustomValidity('Informe o seu nome.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <div class="form-group">
                     <label for="surname">Sobrenome: <span class="span-error">*</span></label>
                     <input class="form-control input-xlarge " type="text"
                     name="surname" id="surname" required
                     oninvalid="setCustomValidity('Informe o seu sobrenome.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <div class="form-group">
                     <label for="email">E-mail:</label>
                     <input class="form-control input-xlarge" type="email"
                     name="email" id="email"
                     oninvalid="setCustomValidity('Informe o seu e-mail.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <div class="form-group">
                     <label for="username">Usuário: <span class="span-error">*</span></label>
                     <input class="form-control input-xlarge" type="text"
                     name="username" id="username" required
                     placeholder="CPF"
                     oninvalid="setCustomValidity('Informe o nome de usuário.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>

                  <div class="form-group">
                     <label for="admin-type">Tipo: <span class="span-error">*</span></label>
                     <select name="admin-type" id="admin-type" class="form-control">
                        <option value="">Selecione o tipo</option>
                        @foreach ($adminTypes as $adminType)
                           <option value="{{$adminType->id}}">{{$adminType->tipo}}</option>
                        @endforeach
                     </select>
                  </div>

                  <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                  <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-check-square-o"></i> Criar</button>
               </fieldset>
            </form>
         </div>
      </div>
   </div>
@endsection
