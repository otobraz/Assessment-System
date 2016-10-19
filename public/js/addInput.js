$(document).on('click', '.btn-add', function(e)
{

   var controlForm = $(this).parents('.dynamic-form-group');
   var currentEntry = $(this).parents('.dynamic-input-group');
   var newEntry = $(currentEntry.clone()).appendTo(controlForm);

   newEntry.find('input').val('');
   controlForm.find('.input-group:not(:last) .btn-add')
   .removeClass('btn-add').addClass('btn-remove')
   .removeClass('btn-success').addClass('btn-danger')
   .html('<span class="glyphicon glyphicon-minus"></span>');

}).on('click', '.btn-remove', function(e){

   $(this).parents('.input-group:first').remove();

   return false;

});

$(document).on('click', '.remove-question', function(e){

   $(this).parents('.question-spot:first').remove();

   return false;

});
