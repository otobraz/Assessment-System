@extends('layout.student.base')

@section('title')
   Orientação | Editar
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">EDITAR ORIENTAÇÃO</h3>
      </div>
      <div class="box-body">

         @include('alert-message.success')

         <form class="form-signin" method="POST" action="{{action('GuidanceController@update', encrypt($guidance->id))}}">

            {{ csrf_field() }}

            {{ method_field('PUT') }}

            <fieldset>

               <div class="form-group">
                  <label for="guidance-type">Tipo da orientação:</label>
                  <select name="guidance-type" id="guidance-type" class="form-control">
                     @foreach ($guidanceTypes as $type)
                        @if($guidance->tipo->id == $type->id)
                           <option value="{{$type->id}}" selected><p></p>{{$type->tipo}}</option>
                        @else
                           <option value="{{$type->id}}"><p></p>{{$type->tipo}}</option>
                        @endif
                     @endforeach
                  </select>
               </div>

               <div class="row">

                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="student">Orientando:</label>
                        <input class="form-control input-xlarge" type="text" name="student" id="student"
                        value="{{$guidance->aluno->nomeCompleto}}" disabled>
                     </div>
                  </div>

                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="student">Matrícula:</label>
                        <input class="form-control input-xlarge" type="text" name="student" id="student"
                        value="{{$guidance->aluno->matricula}}" disabled>
                     </div>
                  </div>

                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="student">Orientador:</label>
                        <input class="form-control input-xlarge" type="text" name="student" id="student"
                        value="{{$guidance->professor->nomeCompleto}}" disabled>
                     </div>
                  </div>


               </div>

               <div class="form-group">
                  <label for="description">Título:</label>
                  <input class="form-control input-xlarge" type="text" name="title" id="title" placeholder="Título da orientação" value="{{$guidance->titulo}}">
               </div>

               <div class="form-group">
                  <label for="description">Descrição:</label>
                  <textarea class="form-control input-xlarge" type="text" name="description" id="description" rows="4" placeholder="Descrição sobre a orientação">{{$guidance->descricao}}</textarea>
               </div>

               {{-- <div class="form-group">
                  <label for="tcc1">TCC I - Proposta:</label>
                  <input type="file" accept=".pdf" id="tcc1" name="tcc1">
                  <p class="help-block">Apenas arquivos do tipo .pdf</p>
               </div>

               <div class="form-group">
                  <label for="tcc2">TCC II - Proposta:</label>
                  <input type="file" accept=".pdf" id="tcc2" name="tcc2">
                  <p class="help-block">Apenas arquivos do tipo .pdf</p>
               </div> --}}

               {{-- <div class="pull-right"> --}}
               <button class="btn btn-default" type="button" onclick="history.go(-1)"> Cancelar</button>
               <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-pencil-square-o"></i> Salvar</button>
               {{-- </div> --}}

            </fieldset>
         </form>

      </div><!-- /.box-body -->
   </div>
@endsection
