<?php include("include/header.php"); ?>


        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Reports</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Reports</li>
              <!-- <li class="breadcrumb-item active" aria-current="page">DataTables</li> -->
            </ol>
          </div>

          <?php
          // this code coming from get_details.php page;

          if(isset($_POST['save'])){
            $user_id = $_POST['user_id'];
            $post_id = $_POST['post_id'];
            $report_id = $_POST['report_id'];
            $action = $_POST['action'];
            if($action==1){
              $post_disactive = Post_disactive($post_id);
              if($post_disactive==1){
              $update_report_status = Report_update($report_id);
                echo alerts(1,"Post Hided Successfully !!");
              }else{
                echo alerts(3,"Post Hided Failed !!");
              }
            }elseif($action==2 ) {
              $post_delete = Post_delete($post_id);
              if($post_delete==1){
            $update_report_status = Report_update($report_id);

              echo alerts(1,"Post Deleted Successfully !!");
            }else{
              echo alerts(3,"Post Deleted Failed !!");
            }
            }elseif($action==3 ) {
              $post_disactive = Post_disactive($post_id);
              if($post_disactive==1){
                $user_disactive = User_disactive($user_id);
                if($user_disactive==1){
                $update_report_status = Report_update($report_id);

                  echo alerts(1,"Post Hided and User Dis Activated Successfully !!");
                }
              }else{
                echo alerts(3,"Post Hided and User Dis Activated Failed !!");
              }
              
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
                        <th>Employee</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Post</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>Employee</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Post</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php  
                      $report = Get_reports();
                      if(mysqli_num_rows($report)>0){
                        while ($rows =  mysqli_fetch_array($report)) {
                      ?>
                      <tr>
                        <td><?php echo $rows['full_name'];  ?></td>
                        <td><?php echo $rows['report_details'];  ?></td>
                        <td><?php echo $rows['report_date'];  ?></td>
                        <td>

                        <a type="button" href="javascript:void(0)" class="view" class="btn btn-primary" data-id="<?= $rows['reporttb_post_id'];  ?>" data-repid="<?= $rows['report_id'];  ?>" data-toggle="modal" data-target="#exampleModal"
                    id="#myBtn">
                    Show
                        </a>


                        </td>
                        <td>
                          
                        <?php 
                           if($rows['report_action']==0){
                            ?>
                          <span class="badge badge-warning">Pending</span>

                           <?php }else{ ?>

                          <span class="badge badge-success">Solved</span>
                            
                           <?php } ?>
                        
                        
                        

                        
                        <td>
                        <a class="dropdown-item" href="posts.php?post_id=<?php echo $rows['post_id']; ?>&action=delete"><span class="btn btn-danger">Delete</span></a>

                        </td>
                      </tr>
                     <?php
                     }
                     }else{
                      // 
                     }
                     ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
          </div>

         
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

                </div>
               
              </div>
            </div>
          </div>



          <!--Row-->
          <?php include("include/footer.php"); ?>
