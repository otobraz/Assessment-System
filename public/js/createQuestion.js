$("button[name='btn-blank-question']").on("click", function(){

   var count = $("div[name='question-spot']").size();
   var selectSpotId = "select-" + count + "-spot";
   var questionSpotId = "question-" + count + "-spot";

   $("#survey-preview-panel > .panel-body").append(
      "<div name='select-question-type-spot' id='" + selectSpotId + "'></div><div name='question-spot' id='" + questionSpotId + "'></div><hr class='hr-ufop'>"
   );

   $("#" + selectSpotId).load("ajax/nova-questao/" + count);
   $("#" + questionSpotId).load("ajax/novo-input/question-" + count + "/2");

});

$("#survey-preview-panel > .panel-body").on("click", ".select-question-type", function(){

   $(this).data('val', $(this).val());

}).on("change", ".select-question-type", function(){

   var questionTypeId = this.value;
   var selectId = $(this).attr('id');
   var previousValue = $(this).data('val');

   if(previousValue == 1 || questionTypeId == 1){

      $("#" + selectId + "-spot").load("ajax/novo-input/" + selectId + "/" + questionTypeId);

   }else if (questionTypeId == 2) {

      var oldName = selectId + "-checkboxes"
      var newName = selectId + "-radios"
      $("input[name='" + oldName + "']").attr("type", "radio");
      $("input[name='" + oldName + "']").attr("name", newName);

   }else if (questionTypeId == 3){

      var oldName = selectId + "-radios"
      var newName = selectId + "-checkboxes"
      $("input[name='" + oldName + "']").attr("type", "checkbox");
      $("input[name='" + oldName + "']").attr("name", newName);

   }

   // switch (questionTypeId) {
   //    case "1":
   //       $("#question-" + count + "-spot").load("ajax/novo-input/" + count + "/" + questionTypeId);
   //       break;
   //
   //    case "2":
   //       $("#question-" + count + "-spot").load("ajax/novo-input/" + count + "/" + questionTypeId);
   //       break;
   //
   //    case "3":
   //       alert(3);
   //       break;
   //
   //    default:
   //       return;
   // }
   // var url = 'ajax/questao/' + questionId;
   // var selectId = $(this).attr('id');
   //
   // if(questionId === ""){
   //    return;
   // }
   //
   // $("#" + selectId + "-spot").text("Carregando");
   // $("#" + selectId + "-spot").load(url);
   // //$("#" + selectId + "-hidden").attr('value', questionId);

});
