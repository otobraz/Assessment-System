<div class="modal fade col-xs-offset-2" name="deleteModal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="confirmDeleteModalTitle">Confirmar</h4>
         </div>
         <div class="modal-body">
            <p class="text-center">Você tem certeza que quer excluir esse tipo de classe</p>
            <br>
            <form class="form" id="delete-form" name="delete-form" action="/" method="post">
               {{ method_field('DELETE') }}
               {{ csrf_field() }}
               <p class="text-center">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-danger">Confirmar</button>
               </p>
            </form>
         </div>
      </div>
   </div>
</div>
