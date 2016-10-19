$("button[name='btn-select-question']").on("click", function(){

   var count = $("div[name='question-spot']").size();
   // var selectSpotId = "select-" + count + "-spot";
   // var questionSpotId = "question-" + count + "-spot";

   $("#survey-preview-panel > .panel-body").append(
      "<div class='question-spot' name='question-spot'><div name='select-question-spot' class='select-question-spot'></div><div name='input-spot'></div></div>"
   );

   // $("fieldset button").before(
   //    "<input name='question-" + count + "-hidden' type='hidden' id='question-" + count + "-hidden' value=''>"
   // );

   $("div[name='select-question-spot']").last().load("ajax/escolher-questao/" + count);

});

$("#survey-preview-panel > .panel-body").on("change", ".select-question", function(){

   var questionId = $(this).val();
   var url = 'ajax/questao/' + questionId;

   if(questionId === ""){
      return;
   }

   var selectDiv = $(this).parents(".select-question-spot:first");
   var inputDiv = selectDiv.next();
   inputDiv.text("Carregando");
   inputDiv.load(url);
   //$("#" + selectId + "-hidden").attr('value', questionId);

});
