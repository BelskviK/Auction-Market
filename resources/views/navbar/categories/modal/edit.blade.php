<!-- Modal -->
<div class="modal hide fade" id="updateCategory" tabindex="-1" role="dialog" aria-labbeledby="updateCategoryLabel" aria-hidden="true">
   <form action="" method="post" id='updateCategoryForm'>
      @csrf 
      <input type="hidden" id="up_id">

      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">

            <div class="modal-header">
               <h4 class="modal-title" id='updateCategoryLabel'>Update Category</h4>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
               <table class="w-100 category-modal-edit">

                  <tbody>

                     <div class="errMsgContainer"></div>

                     <tr class="form">
                        <td width='30%'>
                           <b>    <label for='name' class='col-sm-2 col-form-label'>Name:</label>    </b>
                        </td>
                        <td width='70%'>
                           <div class='col-sm-10'>
                              <input type="text" class="form-control mt-2" name="up_name" id="up_name">
                           </div>
                        </td>
                     </tr>
                     <tr class="form-group sr-only">
                        <td width='20%'><b>   <label for="cogs" class='col-sm-2 col-form-label'>price</label></b></td>
                        <td width='80%'> 
                           <div class='col-sm-10'>
                              <input type="number" class="form-control mt-2" name="cogs" id="cogs">
                           </div>
                        </td>
                     </tr>
                  </table> 

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">✘</button>
               <button type="button" class='btn btn-outline-success update_category'>✔</button>
            </div>
         </div>
      </div>
   </form>
</div>
