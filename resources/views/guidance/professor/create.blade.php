@extends('layout.professor.base')

@section('title')
   Orientação | Criar
@endsection

{{-- @section('content-header')
<h1>Criar novo departamento</h1>
<hr>
@endsection --}}

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">ORIENTAR</h3>
      </div>
      <div class="box-body">

         @include('alert-message.success')

         <form class="form-signin" method="POST" action="{{action('GuidanceController@store')}}">

            {{ csrf_field() }}

            <fieldset>

               <input type="hidden" name="aluno-id" value="{{$student->id}}">

               @if (session()->has('errorMessage'))
                  <div class="form-group has-error">
                     <label for="guidance-type">Tipo da orientação:</label>
                     <select name="guidance-type" id="guidance-type" class="form-control">
                        <option value="">Selecione o tipo da orientação</option>
                        @foreach ($guidanceTypes as $type)
                           <option value="{{$type->id}}"><p></p>{{$type->tipo}}</option>
                        @endforeach
                     </select>
                     <p class="help-block">{{session()->get('errorMessage')}}</p>
                  </div>
               @else
                  <div class="form-group">
                     <label for="guidance-type">Tipo da orientação:</label>
                     <select name="guidance-type" id="guidance-type" class="form-control">
                        <option value="">Selecione o tipo da orientação</option>
                        @foreach ($guidanceTypes as $type)
                           <option value="{{$type->id}}"><p></p>{{$type->tipo}}</option>
                        @endforeach
                     </select>
                     <p class="help-block">{{session()->get('errorMessage')}}</p>
                  </div>
               @endif

               <div class="row">

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="student">Aluno:</label>
                        <input class="form-control input-xlarge" type="text" name="student" id="student"
                        value="{{$student->nomeCompleto}}" disabled>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="student">Matrícula:</label>
                        <input class="form-control input-xlarge" type="text" name="student" id="student"
                        value="{{$student->matricula}}" disabled>
                     </div>
                  </div>

               </div>

               <div class="form-group">
                  <label for="description">Descrição:</label>
                  <textarea class="form-control input-xlarge" type="text" name="description" id="description" rows="4" placeholder="Descrição sobre a orientação"></textarea>
               </div>


               <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
               <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-check-square-o"></i> Orientar</button>

            </fieldset>
         </form>

      </div><!-- /.box-body -->
   </div>
@endsection
