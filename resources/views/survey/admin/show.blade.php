@extends('layout.admin.base')

@section('content-header')
   <h1>{{$survey->titulo}}</h1>
   <br/>
   <h1><small>{{$survey->descricao}}</small></h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="panel panel-default">
      <div class="panel-body panel-survey">

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

         <div class="pull-left">
            <button class="btn btn-default" type="button"
            onclick="history.go(-1)"> Voltar</button>
            <a class="btn btn-primary-ufop" role="button" style="color: white" href="{{action('SurveyController@edit', encrypt($survey->id))}}"> Editar</a>

         </div>


      </div>

   @endsection
