<div name="question" class="form-group">
   @if ($question->type->id == 2)
      {{-- <label for="question-{{$question->id}}-radio">{{$question->question}}</label> --}}
      @foreach ($question->choices as $choice)
         <div class="radio">
            <label>
               <input type="radio" name="question-{{$question->id}}-radio"
               id="question-{{$question->id}}-radio" value="{{$choice->id}}" disabled>
               {{$choice->choice}}
            </label>
         </div>
      @endforeach

   @elseif ($question->type->id == 3)

      {{-- <label for="question-{{$question->id}}-checkbox">{{$question->question}}</label> --}}
      @foreach ($question->choices as $choice)
         <div class="checkbox">
            <label>
               <input type="checkbox" name="question-{{$question->id}}-checkbox[]" value="{{$choice->id}}" disabled>
               {{$choice->choice}}
            </label>
         </div>
      @endforeach
   @else
      {{-- <label for="question-{{$question->id}}-text">{{$question->question}}</label> --}}
      <textarea class="form-control"
      rows="1"
      name="question-{{$question->id}}-text"
      id="question-{{$question->id}}-text"
      placeholder="Digite aqui..." disabled
      ></textarea>
   @endif
</div>
