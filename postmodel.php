                   <!-- Modal -->
                   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">

<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Post Details</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

    <div class="form-group">
          <label for="">Posted By :</label>
          <input type="text" class="form-control"  readonly="readonly" id="exampleFormControlTextarea1">
          
        </div>

      <p>Post Image :</p>
      <img src="include/img/no_image.png" style="width: 150px;"  alt="">
     <br>
     <br>

     <div class="form-group">
          <label for="">Post Description :</label>
          <textarea type="text" class="form-control"  maxlength='50' minlength='50' readonly="readonly" id="exampleFormControlTextarea1">
          </textarea>
        </div>

        <div class="form-group">
          <label for="">Action :</label>
          <select  class="form-control" name="action" >
            <option value="">--Select Action--</option>
            <option value="1">Hide Post</option>
            <option value="2">Delete Post</option>
            <option value="3">Hide Post & Dis Activate User</option>

          </select>
          
        </div>



    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary">Save changes</button>
    </div>
  </div>
</div>
</div>
