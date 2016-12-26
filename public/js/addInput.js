$(document).on('click', '.btn-add', function(e)
{

   var controlForm = $(this).prev();
   var currentEntry = controlForm.children('.dynamic-input-group:first');
   if(!currentEntry.is(":visible")){
      currentEntry.show();
   }else{
      var newEntry = $(currentEntry.last().clone()).appendTo(controlForm);
      newEntry.find('.form-control').val('');
   }


   // newEntry.find('input').val('');
   // controlForm.find('.input-group:not(:last) .btn-add')
   // .removeClass('btn-add').addClass('btn-remove')
   // .removeClass('btn-success').addClass('btn-danger')
   // .html('<span class="glyphicon glyphicon-minus"></span>');

}).on('click', '.btn-remove', function(e){

   if($(this).parents('.dynamic-form-group').children('.dynamic-input-group').size() == 1){
      $(this).parents('.dynamic-input-group:first').hide();
   }else{
      $(this).parents('.dynamic-input-group:first').remove();
   }

   return false;

});

$(document).on('click', '.remove-question', function(e){

   var spot = $(this).parents('.question-spot:first');
   spot.fadeOut(150, function(){
      spot.remove();
   });

   return false;

});
