@extends('layout.student.base')

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
                        <td>{{$student->first_name . " " . $student->last_name}}</td>
                     </tr>
                     <tr>
                        <th>Curso:</th>
                        <td>{{$student->major->major}}</td>
                     </tr>
                     <tr>
                        <th>Login (CPF):</th>
                        <td>{{$student->username}}</td>
                     </tr>
                     <tr>
                        <th>E-mail:</th>
                        <td>{{$student->email}}</td>
                     </tr>

                  </tbody>

               </table>
               <a class="btn btn-primary btn-block" target="_blank" style="color: white" type="button" data-toggle="modal" href="{{action('StudentController@edit')}}"> Editar Cadastro
               </a>


               <!-- <div class="form-horizontal">
                  <div class="form-group">
                     <label for="name" class="control-label col-md-2">Nome</label>
                     <div class="col-md-10">
                        <input class="form-control" type="text" name="name" value="{{$student->first_name . " " . $student->last_name}}" disabled>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="email" class="control-label col-md-2">E-mail</label>
                     <div class="col-md-10">
                        <input class="form-control" type="text" name="email" value="{{$student->email}}" disabled>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="major" class="control-label col-md-2">Curso</label>
                     <div class="col-md-10">
                        <input class="form-control" type="text" name="major" value="{{$student->major->major}}" disabled>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="major" class="control-label col-md-2">Curso</label>
                     <div class="col-md-10">
                        <input class="form-control" type="text" name="major" value="{{$student->major->major}}" disabled>
                     </div>
                  </div>
               </div> -->




            </div>
         </div>

      </div>

   @endsection
