@extends('admin.layout.base')

@section('title')
   Editar Senha
@endsection

@section('content-header')
   <h1>
      Alterar Senha
   </h1>
   <hr>
@endsection

@section('content')

      <div class="row">
         <div class="col-md-offset-4 col-md-6">
            <div class="panel panel-default">
               <div class="panel-body">

                  @include('alert-message.success')

                  <form class="form-signin" method="POST" action="{{action('AdminController@updatePassword', encrypt($admin->id))}}">

                     {{ csrf_field() }}
                     {{ method_field('PUT') }}

                     <input type="hidden" name="id" value="{{encrypt($admin->id)}}">

                     <fieldset>

                        <!-- fake fields are a workaround for chrome autofill getting the wrong fields -->
                        <input style="display:none" type="text" name="fakeusernameremembered"/>
                        <input style="display:none" type="password" name="fakepasswordremembered"/>

                        @if(session('passwordError'))
                           <div class="form-group has-error">
                              <div class="form-group">
                                 <label for="first_name">Senha atual:</label>
                                 <input class="form-control input-xlarge" type="password" name="password" id="password"
                                 placeholder="Senha atual" autofocus required
                                 oninvalid="setCustomValidity('Por favor informe a senha atual.')"
                                 oninput="setCustomValidity('')">
                                 <p class="help-block">{{session('passwordError')}}</p>
                              </div>

                           </div>
                        @else
                           <div class="form-group">
                              <label for="first_name">Senha atual:</label>
                              <input class="form-control input-xlarge" type="password" name="password" id="password"
                              placeholder="Senha atual" autofocus required
                              oninvalid="setCustomValidity('Por favor informe a senha atual.')"
                              oninput="setCustomValidity('')">
                           </div>
                        @endif

                        @if(session('passwordConfirmationError'))
                           <div class="form-group has-error">
                              <div class="form-group">
                                 <label for="last_name">Nova senha:</label>
                                 <input class="form-control input-xlarge " type="password" name="newPassword" id="newPassword"
                                 placeholder="Informe a nova senha" required
                                 oninvalid="setCustomValidity('Por favor informe a nova senha.')"
                                 oninput="setCustomValidity('')"
                                 >
                              </div>

                              <div class="form-group">
                                 <label for="email">Confirme a nova senha:</label>
                                 <input class="form-control input-xlarge" type="password" name="passwordConfirmation" id="passwordConfirmation"
                                 placeholder="Confirme a nova senha" required
                                 oninvalid="setCustomValidity('É necessário confirmar a nova senha')"
                                 oninput="setCustomValidity('')"
                                 >
                              </div>
                              <p class="help-block">{{session('passwordConfirmationError')}}</p>
                           </div>
                        @else
                           <div class="form-group">
                              <label for="last_name">Nova senha:</label>
                              <input class="form-control input-xlarge " type="password" name="newPassword" id="newPassword"
                              placeholder="Informe a nova senha" required
                              oninvalid="setCustomValidity('Por favor informe a nova senha.')"
                              oninput="setCustomValidity('')"
                              >
                           </div>
                           <div class="form-group">
                              <label for="email">Confirme a nova senha:</label>
                              <input class="form-control input-xlarge" type="password" name="passwordConfirmation" id="passwordConfirmation"
                              placeholder="Confirme a nova senha" required
                              oninvalid="setCustomValidity('É necessário confirmar a nova senha')"
                              oninput="setCustomValidity('')"
                              >
                           </div>
                        @endif
                        <button class="btn btn-default" type="button" onclick="history.go(-1)"> Voltar</button>
                        <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-pencil-square-o"></i> Salvar</button>
                     </fieldset>
                  </form>
               </div>
            </div>
         </div>
      </div>

@endsection
