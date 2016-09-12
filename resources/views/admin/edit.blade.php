@extends('dashboard.dashboard_base')

@section('title')
   Editar Administrador
@endsection

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-offset-4 col-md-6">
            <legend>Editar perfil:</legend>
         </div>
      </div>
      <div class="row">
         <div class="col-md-offset-4 col-md-4">
            <form class="form-signin" method="POST" action="{{action('AdminController@update', encrypt($admin->id))}}">

               {{ csrf_field() }}
               {{ method_field('PUT') }}

               <input type="hidden" name="id" value="{{encrypt($admin->id)}}">

               <fildset>

                  <!-- fake fields are a workaround for chrome autofill getting the wrong fields -->
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
                  <div class="form-group">
                     <label for="password">Senha:</label>
                     <input class="form-control input-xlarge " type="password" name="password" id="password"
                     placeholder="Senha" value="{{$admin->password}}" required
                     oninvalid="setCustomValidity('Informe a senha.')"
                     oninput="setCustomValidity('')"
                     >
                  </div>
                  <button class="btn btn-warning pull-right"  type="button" data-toggle="modal" data-action="http://localhost:8000/admin/{{encrypt($admin->id)}}" href="#deleteModal"> Excluir</button>
                  <div class="pull-left">
                     <button class="btn btn-default" type="button" onclick="window.location='{{route('admin.index')}}'"> Cancelar</button>
                     <button class="btn btn-primary" type="submit"><i class="fa fa-pencil-square-o"></i> Salvar</button>
                  </div>
               </fildset>
            </form>
         </div>
      </div>
   </div>

   @include('admin.delete_modal')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
