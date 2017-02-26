@extends('layout.admin.base')

@section('title')
   {{session()->get('first_name')}} | Perfil
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">PERFIL</h3>
      </div>

      <div class="box-body">

         @include('alert-message.success')
         @include('alert-message.error')

         <form class="form-signin" method="POST" action="{{action('AdminController@update', encrypt($admin->id))}}">

            {{ csrf_field() }}

            {{ method_field('PUT') }}

            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="first-name">Nome: <span class="span-error">*</span></label>
                     <input class="form-control" type="text" name="first-name" placeholder="Nome" value="{{$admin->nome}}" autofocus required>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label for="surname">Sobrenome: <span class="span-error">*</span></label>
                     <input class="form-control" type="text" name="surname" placeholder="Sobrenome" value="{{$admin->sobrenome}}" required>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="username">CPF: <span class="span-error">*</span></label>
                     <input class="form-control" type="text" name="username" placeholder="Nome" value="{{$admin->usuario}}" autofocus required>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label for="email">E-mail:</label>
                     <input class="form-control" type="email" name="email" placeholder="Sobrenome" value="{{$admin->email}}">
                  </div>
               </div>
            </div>

            <div class="form-group">
               <label for="admin-type">Tipo: <span class="span-error">*</span></label>
               <select name="admin-type" id="admin-type" class="form-control">
                  @foreach ($adminTypes as $adminType)
                     @if ($adminType == $admin->tipo)
                        <option selected value="{{$adminType->id}}">{{$adminType->tipo}}</option>
                     @else
                        <option value="{{$adminType->id}}">{{$adminType->tipo}}</option>
                     @endif
                  @endforeach
               </select>
            </div>

            <hr>

            {{-- <div class="pull-left">
               <a class="btn btn-primary-ufop" role="button" href="https://zeppelin10.ufop.br/minhaUfop/desktop/login.xhtml" target="_blank"><i class="fa fa-external-link"></i> <span>minhaUFOP</span></a>
            </div> --}}

            <div class="pull-right">
               <button class="btn btn-default" type="button" onclick="history.go(-1)"> Cancelar</button>
               <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-pencil-square-o"></i> Salvar</button>
            </div>

         </form>

      </div><!-- /.box-body -->

   </div>

@endsection
