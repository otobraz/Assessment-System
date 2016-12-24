window.onpageshow= function() {
   $('.clickable-row tbody').find('tr').removeClass('selected-row');
};

$('.clickable-row tbody tr').on('click', function(e){

   if($(e.target).closest('input[type="checkbox"]').length > 0){
      $(this).toggleClass('selected-row');
   }else if($(e.target).closest('a').length > 0){
      return;
   }else{
      $(this).toggleClass('selected-row');
      var input = $(this).find("input");
      input.prop("checked", !input.prop("checked"));
   }

});
