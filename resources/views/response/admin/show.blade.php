@extends('layout.admin.base')

@section('title')
   Resposta | Detalhes
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">{{$survey->titulo}}</h3>
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">

         {{-- <h4>{{$survey->titulo}}</h4> --}}
         <h4><small>{{$survey->descricao}}</small></h4>
         <hr class="hr-ufop">

         <fieldset disabled>

            <input type="hidden" name="survey_id" value="{{encrypt($survey->id)}}">

            @foreach ($questions as $question)
               <div class="form-group">
                  @if ($question->tipo->id == 2)

                     <label for="question-{{$question->id}}-radio">{{$question->pergunta}}</label>
                     @foreach ($question->opcoes as $choice)
                        <div class="radio">
                           <label>
                              @if($answers[$question->id][$choice->id])
                                 <input checked type="radio" name="question-{{$question->id}}-radio"
                                 id="question-{{$question->id}}-radio" value="{{$choice->id}}">
                                 {{$choice->opcao}}
                              @else
                                 <input type="radio" name="question-{{$question->id}}-radio"
                                 id="question-{{$question->id}}-radio" value="{{$choice->id}}">
                                 {{$choice->opcao}}
                              @endif
                           </label>
                        </div>
                     @endforeach

                  @elseif ($question->tipo->id == 3)

                     <label for="question-{{$question->id}}-checkbox">{{$question->pergunta}}</label>
                     @foreach ($question->opcoes as $choice)
                        <div class="checkbox">
                           <label>
                              @if($answers[$question->id][$choice->id])
                                 <input checked type="checkbox" name="question-{{$question->id}}-checkbox[]" value="{{$choice->id}}">
                                 {{$choice->opcao}}
                              @else
                                 <input type="checkbox" name="question-{{$question->id}}-checkbox[]" value="{{$choice->id}}">
                                 {{$choice->opcao}}
                              @endif

                           </label>
                        </div>
                     @endforeach
                  @else
                     <label for="question-{{$question->id}}-text">{{$question->pergunta}}</label>
                     <textarea class="form-control input-xlarge"
                     rows="1"
                     name="question-{{$question->id}}-text"
                     id="question-{{$question->id}}-text"
                     >{{$answers[$question->id]}}
                  </textarea>
               @endif
            </div>
         @endforeach

      </fieldset>

   </div>

</div>

@endsection
