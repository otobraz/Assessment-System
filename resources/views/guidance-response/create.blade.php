@extends('layout.student.base')

@section('title')
   Orientação | Responder
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">{{$guidance->titulo}}</h3>
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">

         {{-- <h4>{{$survey->titulo}}</h4> --}}
         <h4><small>{{$guidance->descricao}}</small></h4>
         <hr class="hr-ufop">

         <form class="form-signin" method="POST" action="{{action('ResponseGuidance@store')}}">

            {{ csrf_field() }}

            <input type="hidden" name="survey-section-id" value="{{$surveySectionId}}">

            <fieldset>

               @foreach ($questions as $question)
                  <div class="form-group">
                     @if ($question->tipo->id == 2)

                        <label for="question-{{$question->id}}-radio">{{$question->pergunta}}</label>
                        @foreach ($question->opcoes as $choice)
                           <div class="radio">
                              <label>
                                 <input type="radio" name="question-{{$question->id}}-radio"
                                 id="question-{{$question->id}}-radio" value="{{$choice->id}}" required>
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
                        placeholder="Digite aqui..." required
                        ></textarea>
                     @endif
                  </div>
               @endforeach

               <div class="pull-left">
                  <button class="btn btn-default" type="button"
                  onclick="history.go(-1)"> Cancelar</button>
                  <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-pencil-square-o"></i> Responder</button>
               </div>

            </fieldset>
         </form>
      </div>
   </div>

@endsection
