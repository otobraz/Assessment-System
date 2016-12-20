@extends('layout.admin.base')

@section('title')
Pergunta | Criar
@endsection

@section('sidebar')
   @include('layout.admin.sidebar')
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">Criar Pergunta</h3>
         <div class="box-tools pull-right">
            {{-- <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> --}}
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">
         @include('alert-message.success')
         @include('alert-message.error')
         <form class="form-signin" method="POST" action="{{action('QuestionController@store')}}">

            {{ csrf_field() }}

            <fieldset>

               {{-- <legend>Adicionar Pergunta</legend> --}}

               <div class="form-group">

                  <label for="question-type">Tipo da Pergunta:</label>
                  <select name="question-type" id="question-type" class="form-control">
                     @foreach ($questionTypes as $questionType)
                        @if ($questionType->id == 2)
                           <option selected value="{{$questionType->id}}">{{$questionType->tipo}}</option>
                        @else
                           <option value="{{$questionType->id}}">{{$questionType->tipo}}</option>
                        @endif
                     @endforeach
                  </select>

               </div>

               <div class="form-group">
                  <label for="question">Pergunta:</label>
                  <input type="text" class="form-control" id="question" name="question" placeholder="Pergunta">
               </div>

               <div id="dynamic-input" class="form-group">
                  @include('question.ajax.radio-input')
               </div>

               <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
               <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-check-square-o"></i> Criar</button>

            </fieldset>
         </form>
      </div><!-- /.box-body -->
   </div><!-- /.box -->

@endsection

@section('myScripts')

   <script src="{{asset('/js/createQuestion.js')}}"></script>
   <script src="{{asset('/js/addInput.js')}}"></script>

@endsection
