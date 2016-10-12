<select name="select-question" id="number-{{$count}}" class="form-control">
   <option value=""></option>
   @foreach ($questions as $question)
      <option value="{{$question->id}}">{{$question->question}}</option>
   @endforeach
   <input type="hidden" name="question-{{$count}}" value="{{$question->id}}">
</select>
