@extends('layout.professor.base')

@section('title')
   Questionário | Detalhes
@endsection

@section('content')


   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">{{$survey->titulo}}</h3>
      </div><!-- /.box-header -->

      <div class="box-body">

         <fieldset disabled>

            {{ csrf_field() }}

            <input type="hidden" name="survey_id" value="{{encrypt($survey->id)}}">

            @foreach ($questions as $question)
               <div class="form-group">
                  @if ($question->tipo->id == 2)

                     <label for="question-{{$question->id}}-radio">{{$question->pergunta}}</label>
                     @foreach ($question->opcoes as $choice)
                        <div class="radio">
                           <label>
                              <input type="radio" name="question-{{$question->id}}-radio"
                              id="question-{{$question->id}}-radio" value="{{$choice->id}}">
                              {{$choice->opcao}}
                           </label>
                        </div>
                     @endforeach

                  @elseif ($question->tipo->id == 3)

                     <label for="question-{{$question->id}}-checkbox">{{$question->pergunta}}</label>
                     @foreach ($question->opcoes as $choice)
                        <div class="checkbox">
                           <label>
                              <input type="checkbox" name="question-{{$question->id}}-checkbox[]" value="{{$choice->id}}">
                              {{$choice->opcao}}
                           </label>
                        </div>
                     @endforeach
                  @else
                     <label for="question-{{$question->id}}-text">{{$question->pergunta}}</label>
                     <textarea class="form-control input-xlarge"
                     rows="1"
                     name="question-{{$question->id}}-text"
                     id="question-{{$question->id}}-text"
                     placeholder="Digite aqui..."
                     ></textarea>
                  @endif
               </div>
            @endforeach

         </fieldset>

      </div>

      <div class="box-footer">
         <button class="btn btn-default" type="button"
         onclick="history.go(-1)"> Voltar</button>
      </div>
      
   </div>

@endsection
