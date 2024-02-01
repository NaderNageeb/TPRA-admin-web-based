<?php
include("include/function.php");


$post_id = $_POST['post_id'];
$report_id = $_POST['report_id'];

$sql = "SELECT * from `posts`p,`users`u where p.user_id = u.user_id and p.post_id = $post_id";
$rs = mysqli_query($conn,$sql);
if(mysqli_num_rows($rs)>0){
    $rows = mysqli_fetch_array($rs);
?>
<form action="reports.php" method="post">
    <div class="form-group">
          <label for="">Posted By :</label>
          <input type="text" class="form-control" value="<?php echo $rows['full_name']; ?>" readonly="readonly" id="exampleFormControlTextarea1">
          
        </div>

      <p>Post Image :</p>
      <?php 
                           if($rows['post_photo']==''){
                            ?>
                        
                        <img src="include/img/no_image.png" style="width: 150px;" alt="">

                           <?php }else{ ?>

                        <img src="uploads/posts/<?php echo $rows['post_photo'];  ?>" style="width: 200px;"  alt="">
                        
                           <?php } ?>
     <br>
     <br>

     <div class="form-group">
          <label for="">Post Description :</label>
          <textarea type="text" class="form-control"  maxlength='50' minlength='50' readonly="readonly" id="exampleFormControlTextarea1">
            <?php echo $rows['post_details']; ?>
          </textarea>
        </div>
<input type="hidden" name="post_id"  value="<?php echo $rows['post_id']; ?>">
<input type="hidden" name="user_id"  value="<?php echo $rows['user_id']; ?>">
<input type="hidden" name="report_id"  value="<?php echo $report_id ?>">


        <div class="form-group">
          <label for="">Action :</label>
          <select  class="form-control" required name="action" >
            <option value="">--Select Action--</option>
            <option value="1">Hide Post</option>
            <option value="2">Delete Post</option>
            <option value="3">Hide Post & Dis Activate User</option>

          </select>
          
        </div>
        <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                  <button type="submit" name="save" class="btn btn-primary">Save changes</button>
        </div>
        </form>      

<?php
}
?>