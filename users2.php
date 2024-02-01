<?php include("include/header.php"); ?>


        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Users</li>
              <!-- <li class="breadcrumb-item active" aria-current="page">DataTables</li> -->
            </ol>
          </div>

          <!-- add user function -->
          <?php
  
   if(isset($_POST['register']))
   {
      $user_name = $_POST['user_name'];
      $full_name = $_POST['full_name'];
      $email  = $_POST['email'];
      $phone = $_POST['phone'];
      $add = $_POST['address'];
      $password = $_POST['password'];
      $user_type = $_POST['type'];
      $department =  $pass = $_POST['department'];

      $Add_user = Add_user($user_name,$email,$phone,$add,$full_name,$user_type,$department,$password);
   }
   
   ?>
       
<!-- update user function -->

<?php
// get user details
if(isset($_GET['user_id']) && isset($_GET['action']) == 'edit'){
  $user_id = $_GET['user_id'];
  $user_detils = User_detils($user_id);
}
// update function

if(isset($_POST['update'])){

  $user_id = $_POST['user_id'];
  $user_name = $_POST['user_name'];
  $full_name = $_POST['full_name'];
  $email  = $_POST['email'];
  $phone = $_POST['phone'];
  $add = $_POST['address'];
  $password = $_POST['password'];
  $user_type = $_POST['type'];
  $department =  $pass = $_POST['department'];

  $update_user = Update_user_account($user_id,$user_name,$full_name,$email,$phone,$add,$user_type,$department,$password);

}

?>
<!-- delete function  & change Status -->
<?php
// active status
if(isset($_GET['active_id']) && isset($_GET['action']) == 'active'){
  $user_id = $_GET['active_id'];
  $user_active = User_active($user_id);
}

// disactive status

if(isset($_GET['disactive_id']) && isset($_GET['action']) == 'disactive'){
  $user_id = $_GET['disactive_id'];
  $user_disactive = User_disactive($user_id);
}


if(isset($_GET['user_id']) && isset($_GET['action']) == 'delete'){
  $user_id = $_GET['user_id'];
  $user_delete = User_delete($user_id);
}



?>








          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
                </div>
                <?php
                // update messages
                 if(isset($_POST['update']))
                 {
                   if($update_user == 1){
                     echo alerts(1,"User Data Updated  !!");
                   }
                  }
                  if(isset($_POST['update']))
                  {
                    if($update_user == 2){
                      echo alerts(3," Error !! User data Not Update !!");
                    }
                   }
                 // add user message
                if(isset($_POST['register']))
                {
                  if($Add_user == 1){
                    echo alerts(2,"This User Already Exist !!");
                  }
                  if($Add_user == 2){
                    echo alerts(1,"User Added Successfully !!");
                  }
                  if($Add_user == 3){
                    echo alerts(3,"Sorry !! User Added Failed");
                  }
                }

                ?>
                <div class="card-body">
                  <form action="manage_user.php" method="POST">
                  <div class="form-group">
                      <label for="">User Name</label>
                      <input type="text" class="form-control" name="user_name" required="required" id="exampleInputname" placeholder="Enter User Name" value="<?php if(isset($user_detils))echo $user_detils['user_name'];else echo ""; ?>">
                      <!-- value="<?php //if(isset($_POST['user_name'])){ echo htmlentities($_POST['user_name']);}  ?>"/> -->
                    </div>
                    <div class="form-group">
                      <label for="">Full Name</label>
                      <input type="text" class="form-control" id="exampleInputname" name="full_name" required="required" placeholder="Enter full Name" value="<?php if(isset($user_detils))echo $user_detils['full_name'];else echo ""; ?>">
                    </div>
                
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name="email" required="required" aria-describedby="emailHelp"
                        placeholder="Enter email" value="<?php if(isset($user_detils))echo $user_detils['email'];else echo ""; ?>">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your
                        email with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="">Address</label>
                      <input type="text" class="form-control" id="exampleInputname" name="address" required="required" placeholder="Enter Address" value="<?php if(isset($user_detils))echo $user_detils['address'];else echo ""; ?>">
                    </div>
                    <?php if(isset($user_detils)){?>
                      <input type="hidden" value="<?php echo $user_detils['user_id']; ?>" name="user_id">
                      <?php  } ?>
                    <div class="form-group">
                      <label for="">Phone</label>
                      <input type="number" class="form-control" id="exampleInputname" name="phone" required="required" placeholder="Enter Phone No" value="<?php if(isset($user_detils))echo $user_detils['phone'];else echo ""; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Department</label>
                      <input type="text" class="form-control" name="department" required="required" id="exampleInputname" placeholder="Enter Department" value="<?php if(isset($user_detils))echo $user_detils['department'];else echo ""; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">User Type</label>
                      <select class="form-control" required = "required" name="type" id="exampleInputname">
                      <!-- value="<?php //if(isset($user_detils))echo $user_detils['user_name'];else echo ""; ?>" -->
                      <?php if(isset($user_detils)){    ?>
                        <option value="<?php echo  $user_detils['user_type'];   ?>">  <?php  if($user_detils['user_type']==1)echo 'Admin';else echo "Employee";   ?> </option>
                        <?php }else{ ?>
                        <option>--Select Type--</option>
                        <?php } ?>
                        <option value="1">Admin</option>
                        <option value="0">Employee</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="password" class="form-control" name="password" required="required" id="exampleInputname" placeholder="Enter Password" value="<?php if(isset($user_detils))echo $user_detils['password'];else echo ""; ?>">
                    </div>
                    <?php if(isset($user_detils)){?>
                    <button name="update" type="submit" class="btn btn-primary">Update</button>
                      <?php }else{ ?>
                    <button name="register" type="submit" class="btn btn-primary">Save</button>
                    <button  type="reset" class="btn btn-dark">Reset</button>
                    <?php }?>



                  </form> 
                </div>
              </div>
              </div>

            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">  </h6>
                </div>
                <?php
             // delete user
                   if(isset($_GET['user_id']) && isset($_GET['action']) == 'delete'){
                    
                  if($user_delete == 1){
                     echo alerts(1,"User Deleted Successfully !!");
                   }
                  if($user_delete == 2){
                   echo alerts(3,"User Deleted Failed !!");
                  }
                                  
                }
                ?>
                <div class="table-responsive p-3">
                  
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                    id="#myBtn">
                    Launch demo modal
                  </button>
                    <thead class="thead-light">
                      <tr>
                        
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <?php  
                    $get_users = Get_users();

                    if(mysqli_num_rows($get_users)>0){

                    while ($rows = mysqli_fetch_array($get_users)) {
                  
                    ?>
                    <tbody>
                      <tr>
                        <td><?php echo $rows['user_name'];   ?></td>
                        <td><?php echo $rows['email'];   ?></td>
                        <td><?php echo $rows['address'];   ?></td>
                        <td><?php echo $rows['department'];   ?></td>
                        <td><?php echo $rows['phone'];   ?></td>
                        <td><?php  if($rows['user_type']==1)echo 'Admin';else echo "Employee";   ?></td>
                        <td>
                          <?php 
                           if($rows['status']==0){
                            ?>
                          <a href="manage_user.php?disactive_id=<?php echo $rows['user_id']; ?>&action=disactive" class="badge badge-success">Active</a>

                           <?php }else{ ?>

                            <a href="manage_user.php?active_id=<?php echo $rows['user_id']; ?>&action=active" class="badge badge-danger">Not Active</a>
                           <?php } ?>

                        </td>
                        <td>
                        <div class="btn-group">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      Action
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="manage_user.php?user_id=<?php echo $rows['user_id']; ?>&action=edit"><span class="btn btn-primary">Edit</span></a>
                      <a class="dropdown-item" href="manage_user.php?user_id=<?php echo $rows['user_id']; ?>&action=delete"><span class="btn btn-danger">Delete</span></a>
                    </div>
                  </div>


                        </td>
                      </tr>
                     <?php } 

                     }else{

                    //  echo"No Data In Table";

                     }
                     
                     ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
          </div>

                    <!-- Modal -->
           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>You Content</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>

          <!--Row-->
          <?php include("include/footer.php"); ?>
