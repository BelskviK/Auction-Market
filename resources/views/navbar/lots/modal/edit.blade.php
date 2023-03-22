<!-- Modal -->
<div class="modal hide fade" id="updateLot" tabindex="-1" role="dialog" aria-labbeledby="updateLotLabel" aria-hidden="true">
   <form action="" method="post" id='updateLotForm'>
      @csrf 
      <input type="hidden" id="up_id">

      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">

            <div class="modal-header">
               <h4 class="modal-title" id='updateLotLabel'>Update Lot</h4>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
               <table class="w-100 lot-modal-edit">

                  <tbody>
                  <div class="errMsgContainer"></div>

                  <tr class="form-group">
                     <td width='20%'><b><label for='name' class='col-sm-2 col-form-label'>Name:</label></b></td>
                     <td width='80%'>
                        <div class='col-sm-10'>
                           <input type="text" class="form-control mt-2" name="up_name" id="up_name">
                        </div>
                     </td>
                  </tr>


                  <tr class="form-group">
                     <td width='20%'><b>   <label for="cogs" class='col-sm-2 col-form-label'>price</label></b></td>
                     <td width='80%'> 
                        <div class='col-sm-10'>
                           <input type="number" class="form-control mt-2" name="up_cogs" id="up_cogs">
                        </div>
                     </td>
                  </tr>


                  <tr class="form-group">
                     <td width='20%'><b><label for="category" class='col-sm-2 col-form-label'>Category</label></b></td>
                     <td width='80%'> 
                        <div class='col-sm-10'>
                           
                           <select id="category" name="category" class="form-select mt-2 span7 pull-right">
                              <option value=""  selected>Select a category</option>
                              @forelse ($categories as $category)
                                 <option value="{{$category->id}}">{{$category->name}}</option>
                              @empty
                                 <option value="">No categories found</option>
                              @endforelse
                           </select>

                        </div>
                     </td>
                  </tr>

                  <tr class="form-group">
                     <td width='20%'><b><label for="description" class='col-sm-2 col-form-label'>description:</label></b></td>
                     <td width='80%'>
                        <div class="col-sm-10">
                           <textarea type="text" class="form-control mt-2" rows="4" name="up_description" id="up_description"></textarea>
                        </div>
                     </td>
                  </tr>



                  <tr class="form-group">
                     <td width='20%'><b><label for="is_active" class='col-sm-2 col-form-label'>Active</label></b></td>
                     <td width='80%'> 
                        <div class='col-sm-10'>

                        <select id="is_active" name="is_active" class="form-select mt-2 pull-right">
                           <option value="0" name="is_active" id="not_active"<?php if (isset($lot) && $lot->is_active != 1) { echo 'selected'; } ?>>Inactive</option>
                           <option value="1" name="is_active" id="active"<?php if (isset($lot) && $lot->is_active == 1) { echo 'selected'; } ?>>On Market</option>
                        </select>

                        
                        </div>
                     </td>
                  </tr>
               </table> 
            </div>
            
            <div class="modal-footer">
               <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">✘</button>
               <button type="button" class='btn btn-outline-success update_lot'>✔</button>
            </div>
         </div>
      </div>
   </form>
</div>
