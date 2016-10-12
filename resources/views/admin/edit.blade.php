@extends('layout.admin.base')

@section('title')
   Editar Administrador
@endsection

@section('content-header')
   <h1>Editar Administrador</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="container">
      <div class="col-md-offset-3 col-md-6">
         <div class="panel panel-default">
            <div class="panel-body">

               @include('alert-message.success')
               @include('alert-message.error')

               <form class="form-signin" method="POST" action="{{action('AdminController@update', encrypt($admin->id))}}">

                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                  <input type="hidden" name="id" value="{{encrypt($admin->id)}}">

                  <fildset>

                     <!-- fake fields are a workaround for browser autofill getting the wrong fields -->
                     <input style="display:none" type="text" name="fakeusernameremembered"/>
                     <input style="display:none" type="password" name="fakepasswordremembered"/>

                     <div class="form-group">
                        <label for="first_name">Nome:</label>
                        <input class="form-control input-xlarge" type="text" name="first_name" id="first_name"
                        placeholder="Nome" value="{{$admin->first_name}}" autofocus required
                        oninvalid="setCustomValidity('Informe o nome.')"
                        oninput="setCustomValidity('')">
                     </div>
                     <div class="form-group">
                        <label for="last_name">Sobrenome:</label>
                        <input class="form-control input-xlarge " type="text" name="last_name" id="last_name"
                        placeholder="Sobrenome" value="{{$admin->last_name}}" required
                        oninvalid="setCustomValidity('Informe o sobrenome.')"
                        oninput="setCustomValidity('')"
                        >
                     </div>
                     <div class="form-group">
                        <label for="email">E-mail</label>
                        <input class="form-control input-xlarge" type="email" name="email" id="email"
                        placeholder="E-mail" value="{{$admin->email}}" required
                        oninvalid="setCustomValidity('Informe o e-mail.')"
                        oninput="setCustomValidity('')"
                        >
                     </div>
                     <div class="form-group">
                        <label for="username">Usuário</label>
                        <input class="form-control input-xlarge" type="text" name="username" id="username"
                        placeholder="Usuário" value="{{$admin->username}}" required
                        oninvalid="setCustomValidity('Informe o nome de usuário.')"
                        oninput="setCustomValidity('')"
                        >
                     </div>

                     <button class="btn btn-warning pull-left"  type="button" data-toggle="modal" data-action="http://localhost:8000/admin/{{encrypt($admin->id)}}" href="#deleteModal"> Excluir</button>
                     <div class="pull-right">
                        <button class="btn btn-default" type="button" onclick="history.go(-1)"> Cancelar</button>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-pencil-square-o"></i> Salvar</button>
                     </div>
                  </fildset>
               </form>
            </div>
            <div class="panel-footer">
               <a class="btn btn-primary btn-block" style="color: white" type="button" data-toggle="modal" href="{{action('AdminController@editPassword', encrypt($admin->id))}}"> Mudar Senha
               </a>
            </div>
         </div>
      </div>
   </div>

   @include('admin.delete-modal')

@endsection

@section('myScripts')
   <script src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
