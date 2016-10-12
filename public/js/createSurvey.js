$("#survey-preview-panel > .panel-body").on("change", "select[name='select-question']", function(){

   var questionId = this.value;
   var url = 'ajax/questao/' + questionId;
   var selectId = $(this).attr('id');

   if(questionId === ""){
      return;
   }

   $("#question-" + selectId).text("Carregando");
   $("#question-" + selectId).load(url);

});

$("button[name='btn-blank-question']").on("click", function(){

   alert("blank");

});

$("button[name='btn-select-question']").on("click", function(){
   var count = $("select[name='select-question']").size();
   var selectSpotId = "select-number-" + count;
   var questionSpotId = "question-number-" + count;
   $("#survey-preview-panel > .panel-body").append(
      "<div id='" + selectSpotId + "'class='form-group'></div><div id='" + questionSpotId + "'></div>"
   );
   $("#" + selectSpotId).load("ajax/questoes-select/" + count);

});
