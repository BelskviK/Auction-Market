<!-- Modal -->
<div class="modal hide" id="addLot" tabindex="-1" role="dialog" aria-labbeledby="addLotLabel" aria-hidden="false">
   <form action="" method="post" id='addLotForm'>
      @csrf 
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">

            <div class="modal-header">
               <h4 class="modal-title " id='addLotLabel'>Adding Lot</h4>
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
                              <input type="text" class="form-control mt-2" name="name" id="name">
                           </div>
                        </td>
                     </tr>


                     <tr class="form-group">
                        <td width='20%'><b>   <label for="cogs" class='col-sm-2 col-form-label'>price</label></b></td>
                        <td width='80%'> 
                           <div class='col-sm-10'>
                              <input type="number" class="form-control mt-2" name="cogs" id="cogs">
                           </div>
                        </td>
                     </tr>


                     <tr class="form-group">
                        <td width='20%'><b><label for="category" class='col-sm-2 col-form-label'>category</label></b></td>
                        <td width='80%'> 
                           <div class='col-sm-10'>
                              <select id="category_select" name="category" class="form-select mt-2 span7 pull-right">
                                 <option value="" selected  >Choose Category</option>
                                 @forelse ($categories as $category)
                                    <option value="{{$category->id}}" name="category_option" id="category_option">{{$category->name}}</option>
                                 @empty
                                 
                                 @endforelse
                              </select>
                           </div>
                        </td>
                     </tr>

                     
                     <tr class="form-group">
                        <td width='20%'><b><label for='description' class='col-sm-2 col-form-label'>description:</label></b></td>
                        <td width='80%'>
                           <div class="form-outline col-sm-10">
                              <textarea type="text" class="form-control mt-2" rows="4" name="description" id="description"></textarea>
                           </div>
                        </td>
                     </tr>

                  </table> 
            </div>

            <div class="modal-footer">
               <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">✘</button>
               <button type="button" class='btn btn-outline-success add_lot'>✔</button>
            </div>

         </div>
      </div>
   </form>
</div>
