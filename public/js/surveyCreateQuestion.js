$("button[name='btn-blank-question']").on("click", function(){

   var count = $("div[name='question-spot']").size();
   // var selectSpotId = "select-" + count + "-spot";
   // var questionSpotId = "question-" + count + "-spot";

   $("#survey-preview-panel > .panel-body").append(
      "<div class='question-spot' name='question-spot'><div name='select-question-spot' class='select-question-spot'></div><div name='input-spot'></div></div>"
   );

   var selectDiv = $("div[name='select-question-spot']").last()
      .append("<div class='text-center'><i class='fa fa-2x fa-refresh fa-spin'></i></div>")
      .load("ajax/nova-questao/" + count)
      .next().load("ajax/novo-input/question-" + count + "/2");
   
});

$("#survey-preview-panel > .panel-body").on("click", ".select-question-type", function(){

   $(this).data('val', $(this).val());

}).on("change", ".select-question-type", function(){

   var questionTypeId = this.value;
   var id = $(this).attr('id');
   var previousValue = $(this).data('val');
   var selectDiv = $(this).parents(".select-question-spot:first");
   var inputDiv = selectDiv.next();

   if(previousValue == 1 || questionTypeId == 1){

      inputDiv.load("ajax/novo-input/" + id + "/" + questionTypeId);

   }else if (questionTypeId == 2) {

      var oldName = id + "-checkboxes";
      var newName = id + "-radios";
      $("input[name='" + oldName + "']").attr("type", "radio");
      $("input[name='" + oldName + "']").attr("name", newName);

   }else if (questionTypeId == 3){

      var oldName = id + "-radios";
      var newName = id + "-checkboxes";
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
