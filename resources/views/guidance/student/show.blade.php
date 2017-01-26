@extends('layout.student.base')

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
            <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{action('GuidanceController@showResponse', encrypt($guidance->id))}}">Ver resposta</a>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <form class="form-signin" method="POST" autocomplete="off" enctype="multipart/form-data" action="{{action('SectionController@storeRegistrationsFromCsv')}}">

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

            {{ csrf_field() }}

            <fieldset>

               <div class="form-group">
                  <label for="tcc1">TCC I - Proposta:</label>
                  <input type="file" accept=".pdf" id="tcc1" name="tcc1">
                  <p class="help-block">Apenas arquivos do tipo .pdf</p>
               </div>

               <div class="form-group">
                  <label for="tcc2">TCC II - Proposta:</label>
                  <input type="file" accept=".pdf" id="tcc2" name="tcc2">
                  <p class="help-block">Apenas arquivos do tipo .pdf</p>
               </div>

            </fieldset>



         </div>

         <div class="box-footer">
            <button class="btn btn-default" type="button"
            onclick="history.go(-1)"> Voltar</button>
            <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-check-square-o"></i> Salvar</button>
         </div>

      </form>

   </div>

@endsection
