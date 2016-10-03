@extends('layout.admin.base')

@section('content-header')
   <h1>{{$survey->name}}</h1>
   <br/>
   <h1><small>{{$survey->description}}</small></h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="container">
      <div class="panel panel-default">
         <div class="panel-body panel-survey">
            <form class="form-signin" method="POST" action="{{action('ResponseController@store')}}">

               {{ csrf_field() }}

               <input type="hidden" name="survey_id" value="{{encrypt($survey->id)}}">

               <fildset>

                  @foreach ($questions as $question)
                     <div class="form-group">
                        @if ($question->type->id == 2)

                           <label for="question-{{$question->id}}-radio">{{$question->question}}</label>
                           @foreach ($question->choices as $choice)
                              <div class="radio">
                                 <label>
                                    <input type="radio" name="question-{{$question->id}}-radio"
                                    id="question-{{$question->id}}-radio" value="{{$choice->id}}">
                                    {{$choice->choice}}
                                 </label>
                              </div>
                           @endforeach

                        @elseif ($question->type->id == 3)

                           <label for="question-{{$question->id}}-checkbox">{{$question->question}}</label>
                           @foreach ($question->choices as $choice)
                              <div class="checkbox">
                                 <label>
                                    <input type="checkbox" name="question-{{$question->id}}-checkbox[]" value="{{$choice->id}}">
                                    {{$choice->choice}}
                                 </label>
                              </div>
                           @endforeach
                        @else
                           <label for="question-{{$question->id}}-text">{{$question->question}}</label>
                           <textarea class="form-control input-xlarge"
                           rows="1"
                           name="question-{{$question->id}}-text"
                           id="question-{{$question->id}}-text"
                           placeholder="Digite aqui..."
                           ></textarea>
                        @endif
                     </div>
                  @endforeach

                  <div class="pull-left">
                     <button class="btn btn-default" type="button"
                     onclick="history.go(-1)"> Cancelar</button>
                     <button class="btn btn-primary" type="submit"><i class="fa fa-pencil-square-o"></i> Responder</button>
                  </div>

               </fildset>
            </form>
         </div>
      </div>

   @endsection
