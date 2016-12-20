@extends('layout.student.base')

@section('title')
   {{session()->get('first_name')}} | Perfil
@endsection

@section('content-header')
   <h1>Perfil</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="col-md-offset-3 col-md-6">
      <div class="panel panel-ufop panel-default">
         <div class="panel-body">
            <table class="table h4 table-condensed table-responsive">
               <tbody>
                  <tr>
                     <th>Nome:</th>
                     <td>{{$student->nome . " " . $student->sobrenome}}</td>
                  </tr>
                  <tr>
                     <th>Curso:</th>
                     <td>{{$student->curso->curso}}</td>
                  </tr>
                  <tr>
                     <th>Matrícula:</th>
                     <td>{{$student->matricula}}</td>
                  </tr>
                  <tr>
                     <th>Login (CPF):</th>
                     <td>{{$student->usuario}}</td>
                  </tr>
                  <tr>
                     <th>E-mail:</th>
                     <td>{{$student->email}}</td>
                  </tr>

               </tbody>

            </table>
            <a class="btn btn-primary-ufop btn-block" target="_blank" style="color: white" type="button" data-toggle="modal" href="{{action('StudentController@edit')}}"> Editar Cadastro
            </a>

         </div>
      </div>

   @endsection
