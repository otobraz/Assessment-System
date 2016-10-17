<div class="form-group">
   <select name="question-{{$count}}-type" id="question-{{$count}}" class="form-control select-question-type">
      @foreach ($questionTypes as $questionType)
         @if ($questionType->id == 2)
            <option selected value="{{$questionType->id}}">{{$questionType->type}}</option>
         @else
            <option value="{{$questionType->id}}">{{$questionType->type}}</option>
         @endif
      @endforeach
   </select>
</div>

<div class="form-group">
   <input type="text" class="form-control" id="question-{{$count}}-name" placeholder="Questão">
</div>
