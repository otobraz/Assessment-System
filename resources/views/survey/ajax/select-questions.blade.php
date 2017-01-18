<div class="form-group">

   <div class="btn-div">
      <a class="remove-question" href=""><span class="glyphicon glyphicon-trash fa-lg"></span></a>
   </div>

   <div class="row">
      <div class="col-md-12">
         <select name="question-{{$count}}" id="question-{{$count}}" class="pull-left form-control select-question" required>
            <option value="">Selecione a pergunta</option>
            <optgroup label="Suas perguntas">
               @foreach ($professorQuestions as $question)
                  <option value="{{$question->id}}"><p></p>{{$question->pergunta}}</option>
               @endforeach
            </optgroup>
            <optgroup label="Perguntas padrão">
               @foreach ($defaultQuestions as $question)
                  <option value="{{$question->id}}">{{$question->pergunta}}</option>
               @endforeach
            </optgroup>
         </select>
      </div>
   </div>

</div>
