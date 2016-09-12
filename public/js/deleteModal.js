$('#deleteModal').on('show.bs.modal', function(e) {
   //get data-id attribute of the clicked element
   var action = $(e.relatedTarget).data('action');
   // var model = $(e.relatedTarget).data('model');
   $('#delete-form').attr('action', action);
});
