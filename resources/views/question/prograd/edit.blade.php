@extends('layout.prograd.base')

@section('title')
   Pergunta | Editar
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">Modificar Questão</h3>
         <div class="box-tools pull-right">
            {{-- <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> --}}
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">

         @include('alert-message.success')
         @include('alert-message.error')

         <form class="form-signin" method="POST" action="{{action('QuestionController@update', encrypt($question->id))}}">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <fieldset>

               <input type="hidden" name="id" value="{{encrypt($question->id)}}">

               <div class="form-group">
                  <label for="question-type">Pergunta:</label>
                  <input type="text" class="form-control" id="question" name="question" value="{{$question->pergunta}}" placeholder="Pergunta">
               </div>


               <div class="form-group">

                  @if ($question->tipo_id == 2)
                     <label>Opções:</label>
                        @foreach ($question->opcoes as $choice)
                           <div class="dynamic-input-group input-group">
                           <span class="input-group-addon">
                              <input type="radio" disabled aria-label="...">
                           </span>
                           <input type="text" class="form-control" name="choices[{{$choice->id}}]" value="{{$choice->opcao}}">
                           </div><!-- /input-group -->
                        @endforeach
                  @endif

               </div>

               <button class="btn btn-danger pull-left"  type="button" data-toggle="modal" data-action="http://localhost:8000/pergunta/{{encrypt($question->id)}}" href="#deleteModal"> Excluir</button>

               <div class="pull-right">
                  <button class="btn btn-default" type="button" onclick="history.go(-1)"> Cancelar</button>
                  <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-pencil-square-o"></i> Editar</button>
               </div>

            </fieldset>
         </form>
      </div>
   </div>

   @include('question.delete-modal')

@endsection

@section('myScripts')
   <script type="text/javascript" src="{{URL::asset('/js/deleteModal.js')}}"></script>
@endsection
