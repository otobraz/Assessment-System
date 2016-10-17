$("#survey-preview-panel > .panel-body").on("change", ".select-question", function(){

   var questionId = this.value;
   var url = 'ajax/questao/' + questionId;
   var selectId = $(this).attr('id');

   if(questionId === ""){
      return;
   }

   $("#" + selectId + "-spot").text("Carregando");
   $("#" + selectId + "-spot").load(url);
   //$("#" + selectId + "-hidden").attr('value', questionId);

});

$("button[name='btn-select-question']").on("click", function(){

   var count = $("div[name='question-spot']").size();
   var selectSpotId = "select-" + count + "-spot";
   var questionSpotId = "question-" + count + "-spot";

   $("#survey-preview-panel > .panel-body").append(
      "<div name='select-question-spot' id='" + selectSpotId + "'></div><div name='question-spot' id='" + questionSpotId + "'></div><hr class='hr-ufop'>"
   );

   // $("fieldset button").before(
   //    "<input name='question-" + count + "-hidden' type='hidden' id='question-" + count + "-hidden' value=''>"
   // );

   $("#" + selectSpotId).load("ajax/escolher-questao/" + count);

});
