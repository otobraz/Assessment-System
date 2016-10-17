<div class="form-group">
   <select name="question-{{$count}}" id="question-{{$count}}" class="form-control select-question">
      <option value="">Selecione a questão</option>
      @foreach ($questions as $question)
         <option value="{{$question->id}}">{{$question->question}}</option>
      @endforeach
   </select>
</div>
