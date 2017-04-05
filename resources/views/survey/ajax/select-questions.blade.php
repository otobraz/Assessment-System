<div class="form-group">

   <div class="btn-div">
      <a class="remove-question" href=""><span class="glyphicon glyphicon-trash fa-lg"></span></a>
   </div>

   <div class="row">
      <div class="col-md-12">
         <select name="question-{{$count}}" id="question-{{$count}}" class="pull-left form-control select-question" required>
               @foreach ($questions as $question)
                  <option value="{{$question->id}}">{{$question->pergunta}}</option>
               @endforeach
         </select>
      </div>
   </div>

</div>
