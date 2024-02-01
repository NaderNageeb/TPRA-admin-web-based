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
          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Reports</h6>
                </div>
                <div class="card-body">
                  <form action="system_report.php"  method="POST">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Post Status</label>
                      <select name="status"  class="form-control" >
                        <option value="">-Select Status-</option>
                        <option value="0"> Active Posts </option>
                        <option value="1"> Dis Active Posts </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="date" name="date" class="form-control">
                    </div>
                    <button name="search" type="submit" class="btn btn-primary">Search</button>
                  </form>
                </div>
              </div>
              </div>

     
            <!-- DataTable with Hover -->
            
            <div class="col-lg-12">
            <?php
          
          if(isset($_POST['search'])){
            $status = $_POST['status'];
            $date = $_POST['date'];

            if($status =='' && $date ==''){
            echo alerts(3,"Search By Post Status Or Post Date !!");
            }else{
              $search = Search($status,$date);       

          ?>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">
                <button id="toggleButton" onclick="printDiv('printMe');" class="btn btn-primary active">Print Table</button>
                </h6>
                </div>

                <div class="table-responsive p-3" id="printMe">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                      <th>Photo</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Post Details</th>
                        <th>Date</th>
                        <th>Status</th>
                        <!-- <th>Action</th> -->
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
                        <!-- <th>Action</th> -->
                      </tr>
                    </tfoot>
                    <?php
              $search = Search($status,$date);       
                    if(mysqli_num_rows($search)>0){
                    
                      while($rows = mysqli_fetch_array($search)){
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
                          <span  class="badge badge-success">Active</span>

                           <?php }else{ ?>

                            <span class="badge badge-danger">Non-Active</span>
                           <?php } ?>

                        </td>
                        <!-- <td>

                      <a class="dropdown-item" href="posts.php?post_id=<?php //echo $rows['post_id']; ?>&action=delete"><span class="btn btn-danger">Delete</span></a>

                        </td> -->

                      </tr>

                    </tbody>
                    <?php 
                    }
                  }else{
                    echo alerts(3,"No Data Result !!");
                  }
                  
                  ?>
                  </table>
                </div>

              </div>
            </div>

            <?php
          }
          } 
          
          ?>
            
          </div>
          <!--Row-->

          <script>
    
		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
  

	</script>
          <?php include("include/footer.php"); ?>
