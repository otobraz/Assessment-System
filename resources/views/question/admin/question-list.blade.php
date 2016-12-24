<div class="box box-primary-ufop">
   <div class="box-header with-border">
      <h3 class="box-title">Perguntas</h3>

   <div class="box-tools pull-right">
      <a class="btn btn-primary-ufop btn-sm" role="button"
      href="{{route('question.create')}}">Criar pergunta</a>
   </div><!-- /.box-tools -->
</div><!-- /.box-header -->

<div class="box-body">

   @include('alert-message.success')
   @include('alert-message.error')

   <div class="row">
      <div class="text-center">
         <h3 style="margin-bottom: 20px;"><i class="fa fa-circle-o text-green"></i> Questões Fechadas - Única Escolha</h3>
      </div>

      @foreach ($singleChoiceQuestions as $question)

         <div class="col-md-12">
            <div class="box box-success">
               <div class="box-header with-border">
                  <h3 class="box-title">{{$question->pergunta}}</h3>

               </div><!-- /.box-header -->

               <div class="box-body">
                  <div class="pull-right">
                     <a class="btn btn-warning btn-xs" role="button"
                     style="color: white" href="{{action('QuestionController@edit', encrypt($question->id))}}">Editar</a>
                     <a class="btn btn-danger btn-xs" role="button"
                     style="color: white" data-toggle="modal" href="#deleteModal" data-action="pergunta/{{encrypt($question->id)}}">Excluir</a>
                  </div><!-- /.box-tools -->
                  <fieldset disabled>
                     @foreach ($question->opcoes as $choice)
                        <div class="radio">
                           <label>
                              <input type="radio" name="question-{{$question->id}}-radio"
                              id="question-{{$question->id}}-radio" value="{{$choice->id}}">
                              {{$choice->opcao}}
                           </label>
                        </div>
                     @endforeach
                  </fieldset>

               </div><!-- /.box-body -->
            </div><!-- /.box -->
         </div>

      @endforeach

   </div>

   <div class="row">

      <div class="text-center">
         <h3 style="margin-bottom: 20px;"><i class="fa fa-circle-o text-blue"></i> Questões Fechadas - Múltipla Escolha</h3>
      </div>

      @foreach ($multipleChoiceQuestions as $question)

         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title">{{$question->pergunta}}</h3>
               </div><!-- /.box-header -->

               <div class="box-body">

                  <div class="pull-right">
                     <a class="btn btn-warning btn-xs" role="button"
                     style="color: white" href="{{action('QuestionController@edit', encrypt($question->id))}}">Editar</a>
                     <a class="btn btn-danger btn-xs" role="button"
                     style="color: white" data-toggle="modal" href="#deleteModal" data-action="pergunta/{{encrypt($question->id)}}">Excluir</a>
                  </div><!-- /.box-tools -->

                  <fieldset disabled>
                     @foreach ($question->opcoes as $choice)
                        <div class="checkbox">
                           <label>
                              <input type="checkbox" name="question-{{$question->id}}-checkbox[]" value="{{$choice->id}}">
                              {{$choice->opcao}}
                           </label>
                        </div>
                     @endforeach
                  </fieldset>
               </div><!-- /.box-body -->
            </div><!-- /.box -->
         </div>

      @endforeach

   </div>

   <div class="row">

      <div class="text-center">
         <h3 style="margin-bottom: 20px;"><i class="fa fa-circle-o text-yellow"></i> Questões Abertas</h3>
      </div>

      @foreach ($textQuestions as $question)

         <div class="col-md-12">
            <div class="box box-warning">
               <div class="box-header with-border">
                  <h3 class="box-title">{{$question->pergunta}}</h3>
               </div><!-- /.box-header -->

               <div class="box-body">

                  <div class="pull-right">
                     <a class="btn btn-warning btn-xs" role="button"
                     style="color: white" href="{{action('QuestionController@edit', encrypt($question->id))}}">Editar</a>

                     <a class="btn btn-danger btn-xs" role="button"
                     style="color: white" data-toggle="modal" href="#deleteModal" data-action="pergunta/{{encrypt($question->id)}}">Excluir</a>
                  </div><!-- /.box-tools -->

                  <br/>
                  <br/>
                  <fieldset disabled>
                     <textarea class="form-control input-xlarge"
                     rows="1"
                     name="question-{{$question->id}}-text"
                     id="question-{{$question->id}}-text"
                     placeholder="Digite aqui..."
                     ></textarea>
                  </fieldset>
               </div><!-- /.box-body -->
            </div><!-- /.box -->
         </div>

      @endforeach

   </div>

</div><!-- /.box-body -->
</div><!-- /.box -->

@include('question.admin.delete-modal')
