<?php include("include/header.php"); ?>


        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Postes</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Posts</li>
              <!-- <li class="breadcrumb-item active" aria-current="page">DataTables</li> -->
            </ol>
          </div>


          <?php

// active status
if(isset($_GET['active_id']) && isset($_GET['action']) == 'active'){
  $post_id = $_GET['active_id'];
  $post_active = Post_active($post_id);
}

// disactive status

if(isset($_GET['disactive_id']) && isset($_GET['action']) == 'disactive'){
  $post_id = $_GET['disactive_id'];
  $post_disactive = Post_disactive($post_id);
}

if(isset($_GET['post_id']) && isset($_GET['action']) == 'delete'){
  $post_id = $_GET['post_id'];
  $post_delete = Post_delete($post_id);
  if($post_delete==1){
    echo alerts(1,"Post Deleted Successfully !!");
  }else{
    echo alerts(3,"Post Deleted Failed !!");
  }
}


?>


          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">  </h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Photo</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Post Details</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                       <th>Photo</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Post Details</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>

                      </tr>
                    </tfoot>

                    <?php
                   $get_posts  = Get_posts();
                   if(mysqli_num_rows($get_posts)>0){

                    while ($rows = mysqli_fetch_array($get_posts)) {
                    ?>
                    <tbody>
                      <tr>
                        <td>

                        <?php 
                           if($rows['post_photo']==''){
                            ?>
                        
                        <img src="include/img/no_image.png"  alt="">

                           <?php }else{ ?>

                        <img src="uploads/posts/<?php echo $rows['post_photo'];  ?>" style="width: 50px;"  alt="">
                        
                           <?php } ?>


                        </td>

                        <td><?php echo $rows['full_name'];   ?></td>
                        <td><?php echo $rows['department'];   ?></td>
                        <td>
                        <div class="form-group">
                      <textarea class="form-control"  maxlength='50' minlength='50' readonly="readonly" id="exampleFormControlTextarea1"  >
                      <?php echo  $rows['post_details']; ?>
                      </textarea>
                        </div>  
                      </td>
                        <td><?php echo $rows['post_date'];   ?></td>


                        <td>

                        <?php 
                           if($rows['post_status']==0){
                            ?>
                          <a href="posts.php?disactive_id=<?php echo $rows['post_id']; ?>&action=disactive" title="Dis Activate" class="badge badge-success">Active</a>

                           <?php }else{ ?>

                            <a href="posts.php?active_id=<?php echo $rows['post_id']; ?>&action=active" title="Activate" class="badge badge-danger">Not Active</a>
                           <?php } ?>

                        </td>
                        <td>

                      <a class="dropdown-item" href="posts.php?post_id=<?php echo $rows['post_id']; ?>&action=delete"><span class="btn btn-danger">Delete</span></a>

                        </td>

                      </tr>
                    </tbody>
                    
                    <?php 
                   }
                  }else{
                      // 
                    } ?>
                  </table>
                </div>
              </div>
            </div>
            
          </div>
          <!--Row-->
          <?php include("include/footer.php"); ?>
