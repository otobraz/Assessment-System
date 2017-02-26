$("#question-type").on("click", function(){

   $(this).data('val', $(this).val());

}).on("change", function(){

   var questionTypeId = this.value;
   var id = $(this).attr('id');
   var previousValue = $(this).data('val');
   var inputDiv = $("#dynamic-input");

   if(previousValue == 1 || questionTypeId == 1){
      
      inputDiv.load("ajax/novo-input/" + questionTypeId);

   }else if (questionTypeId == 2) {

      var oldName = "question-checkboxes";
      var newName = "question-radios";
      $("input[name='" + oldName + "']").attr("type", "radio");
      $("input[name='" + oldName + "']").attr("name", newName);

   }else if (questionTypeId == 3){

      var oldName = "question-radios";
      var newName = "question-checkboxes";
      $("input[name='" + oldName + "']").attr("type", "checkbox");
      $("input[name='" + oldName + "']").attr("name", newName);

   }

});
