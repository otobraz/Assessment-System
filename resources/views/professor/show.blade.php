@extends('layout.professor.base')

@section('title')
   {{session()->get('first_name')}} | Perfil
@endsection

@section('content-header')
   <h1>Perfil</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="container">
      <div class="col-md-offset-3 col-md-6">
         <div class="panel panel-ufop panel-default">
            <div class="panel-body">
               <table class="table h4 table-condensed table-responsive">
                  <tbody>
                     <tr>
                        <th>Nome:</th>
                        <td>{{$professor->first_name . " " . $professor->last_name}}</td>
                     </tr>
                     <tr>
                        <th>Departamento:</th>
                        <td>{{$professor->departamento->departamento}}</td>
                     </tr>
                     <tr>
                        <th>Login (CPF):</th>
                        <td>{{$professor->username}}</td>
                     </tr>
                     <tr>
                        <th>E-mail:</th>
                        <td>{{$professor->email}}</td>
                     </tr>

                  </tbody>

               </table>
               <a class="btn btn-primary btn-block" target="_blank" style="color: white" type="button" data-toggle="modal" href="{{action('ProfessorController@edit')}}"> Editar Cadastro
               </a>

            </div>
         </div>
      </div>
   </div>

@endsection
