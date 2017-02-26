@extends('layout.professor.base')

@section('title')
   Orientação | Detalhes
@endsection

{{-- @section('content-header')
<h1>Perfil</h1>
<hr class="hr-ufop">
@endsection --}}

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">{{$guidance->tipo->tipo}}</h3>
         <div class="box-tools pull-right">
            {{-- <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{action('GuidanceController@showResponse', encrypt($guidance->id))}}">Ver resposta</a> --}}
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">

         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="student">Orientando:</label>
                  <input class="form-control input-xlarge" type="text" name="student" id="student"
                  value="{{$guidance->aluno->nomeCompleto}}" disabled>
               </div>
            </div>

            <div class="col-md-6">
               <div class="form-group">
                  <label for="student">Orientador:</label>
                  <input class="form-control input-xlarge" type="text" name="student" id="student"
                  value="{{$guidance->professor->nomeCompleto}}" disabled>
               </div>
            </div>

            <div class="col-md-6">
               <div class="form-group">
                  <label for="student">Titulo:</label>
                  <input class="form-control input-xlarge" type="text" name="student" id="student"
                  value="{{$guidance->titulo}}" disabled>
               </div>
            </div>

            <div class="col-md-6">
               <div class="form-group">
                  <label for="student">Status:</label>
                  <input class="form-control input-xlarge" type="text" name="student" id="student"
                  value="{{$guidance->status ? 'Em andamento' : 'Finalizada'}}" disabled>
               </div>
            </div>
         </div>

         <label>Descrição:</label>
         <div class="panel panel-default">
            <div class="panel-body">
               {{$guidance->descricao}}
            </div>
         </div>

         <hr>

         <a class="btn btn-primary-ufop" role="button" href="{{route('guidance.edit', encrypt($guidance->id))}}"> <i class="fa fa-edit"></i> Editar</a>

      </div>
   </div>

@endsection
