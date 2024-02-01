<?php

include("connect.php");

$date = date('Y-m-d');

//Login//
if(isset($_GET['login'])){

    if (isset($_POST["username"])){
        $username =   filterRequest("username");
        $user_pass =   filterRequest("password");

       $sql = "select * from `users` where  `user_name` = '{$username}' and `password` = '$user_pass' and  `status`= 0  and  `user_del` = 0 ";
       $query = mysqli_query($conn,$sql);
       if(mysqli_num_rows($query)>0){
       
           $data = mysqli_fetch_assoc($query);
           
           echo json_encode(array("status"=>"success" , "data"=>$data));
       }else{
       
            echo json_encode(array("status"=>"Faild"));
       }
       }else{
           echo json_encode(array("status"=>"Accces Denied"));
       }

     }


     //Login//
if(isset($_GET['profiledata'])){

        $user_id =   filterRequest("user_id");
        

       $sql = "SELECT * FROM `users` where  `user_id` = $user_id and  `status`= 0  and  `user_del` = 0 ";
       $query = mysqli_query($conn,$sql);
       if(mysqli_num_rows($query)>0){
       
           $data = mysqli_fetch_assoc($query);
           
           echo json_encode(array("status"=>"success" , "data"=>$data));
       }else{
       
            echo json_encode(array("status"=>"Faild"));
       }
      

     }
   
   

// registration
if(isset($_GET['register'])){

    
$username = filterRequest("username");
$full_name = filterRequest("fullname");
$department = filterRequest("department");
$email = filterRequest("email");
$phone = filterRequest("phone");
$address = filterRequest("address");
$password = filterRequest("password");



$sql_check = "SELECT * FROM users where `user_name` = '$username'";
$query_check = mysqli_query($conn,$sql_check);
if(mysqli_num_rows($query_check)){

    // echo "This user Exist";
    echo json_encode(array("status"=>"Exist"));
}else{

    $sqli_insert = "insert into users (`user_name`,`full_name`,`department`,`email`,`password`,`address`,`phone`,`user_image`) 
    values ('$username','$full_name','$department','$email','$password','$address','$phone','no_image.png')";
    if($query_insert = mysqli_query($conn,$sqli_insert))
    {
        // echo " Data Inserted";
        echo json_encode(array("status"=>"success"));
    }else{
        //echo  $sqli_insert;
        echo json_encode(array("status"=>"Faild"));
    }

}


}


// Uploade Post

if (isset($_GET['addpost'])) {
    
    $user_id = filterRequest("user_id"); //requierd
    $post_details = filterRequest("post_details");//requierd

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
    
        // File properties
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
    
        // Get the file extension
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
        // Define allowed file extensions
        $allowed_extensions = array('jpg','jpeg', 'png','ico');
        // Define the maximum file size in bytes (e.g., 1MB = 1048576 bytes , 2MB = 2097152 bytes)
        $max_file_size = 1048576; // 1MB
       
    
        // Check if the file has a valid extension
        if (in_array($file_ext, $allowed_extensions)) {
            // Check if the file size is within the allowed limit
            if ($file_size <= $max_file_size) {
            // Check if there are no errors during the upload
            if ($file_error === 0) {
                // Specify the directory where you want to save the uploaded file
                $upload_directory = '../../uploads/posts/';
                $new_file_name = mysqli_real_escape_string($conn,$file_name);
    // sql if item exist
    $sql_check = "SELECT * FROM `posts` where
     `post_details` = '$post_details' and `post_del` = 0";
    $query_check = mysqli_query($conn,$sql_check);
    if(mysqli_num_rows($query_check)){
    
        echo json_encode(array("status"=>"Exist"));
    }else{
    // insert into db
        $sqli_insert = "insert into posts(`user_id`,`post_details`,`post_photo`,`post_date`) 
        values ('$user_id','$post_details','$new_file_name','{$date}')";
        if($query_insert = mysqli_query($conn,$sqli_insert))
        {
            // echo " Data Inserted";
            // Move the temporary file to the desired location
            // move_uploaded_file($file_tmp, $upload_directory . $file_name);
    
            if (file_exists($upload_directory . $file_name)) {
                // echo "File already exists.";
                echo json_encode(array("massege"=>"File already exists","status"=>"success"));
            } else {
                // Move the temporary file to the desired location
                move_uploaded_file($file_tmp, $upload_directory . $file_name);
    
                 echo json_encode(array("status"=>"success"));
        }
        }else{
           // echo  $sqli_insert;
            echo json_encode(array("status"=>"Faild"));
        }
    
    }
            } else {
                echo json_encode(array("status"=>"Uplaoding_Error"));
            } 
        } else {
                // echo "File size exceeds the maximum limit of " . $max_file_size . " bytes.";
                echo json_encode(array("status"=>"File_size_Error"));
    
            }
        } else {
            // echo "Invalid file extension. Only JPG, JPEG, and PNG files are allowed.";
            echo json_encode(array("status"=>"Invalid_file_extension"));
        }
    }else{
    
        // insert into db
        $sql_check = "SELECT * FROM `posts` where
        `post_details` = '$post_details' and `post_del` = 0";
    $query_check = mysqli_query($conn,$sql_check);
    if(mysqli_num_rows($query_check)){
    
       echo json_encode(array("status"=>"Exist"));
    }else{
    
        $sqli_insert = "insert into posts(`user_id`,`post_details`,`post_date`) 
        values ('$user_id','$post_details','{$date}')";
       if($query_insert = mysqli_query($conn,$sqli_insert))
       {
        // echo $sqli_insert;
        echo json_encode(array("status"=>"success"));
       }else{
          echo json_encode(array("status"=>"Faild"));
       }
    }
    
    }

}


if(isset($_GET['editPost'])){

    $post_id = $_POST['post_id'];
    $old_image = $_POST['old_image'];
    // $user_id = $_POST['user_id'];
    $post_details = $_POST['post_details'];

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        
    
        // File properties
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
    
        // Get the file extension
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
        // Define allowed file extensions
        $allowed_extensions = array('jpg','jpeg', 'png','ico');
        // Define the maximum file size in bytes (e.g., 1MB = 1048576 bytes , 2MB = 2097152 bytes)
        $max_file_size = 1048576; // 1MB
       
    
        // Check if the file has a valid extension
        if (in_array($file_ext, $allowed_extensions)) {
            // Check if the file size is within the allowed limit
            if ($file_size <= $max_file_size) {
            // Check if there are no errors during the upload
            if ($file_error === 0) {
                // Specify the directory where you want to save the uploaded file
                $upload_directory = '../../uploads/posts/';
                $new_file_name = mysqli_real_escape_string($conn, $file_name);
    // Update data into db
        $sqli_update = "UPDATE `posts` SET  
         `post_details` = '$post_details',
         `post_photo` = '$new_file_name'
          where `post_id` = $post_id";
        if($query_update = mysqli_query($conn,$sqli_update))
        {
          
            if (file_exists($upload_directory . $old_image)) {
                // echo "File already exists.";
                //  echo json_encode(array("massege"=>"File already exists","status"=>"success"));
                // unlink($file);
                unlink($upload_directory . $old_image);
                move_uploaded_file($file_tmp, $upload_directory . $file_name);
    
                echo json_encode(array("status"=>"success"));
            } else {
                // Move the temporary file to the desired location
                move_uploaded_file($file_tmp, $upload_directory . $file_name);
    
                 echo json_encode(array("status"=>"success"));
        }
    
    
        }else{
            echo  $sqli_update;
            echo json_encode(array("status"=>"Faild"));
        }
    
     
            } else {
                echo json_encode(array("status"=>"Uplaoding_Error"));
            } 
        } else {
                // echo "File size exceeds the maximum limit of " . $max_file_size . " bytes.";
                echo json_encode(array("status"=>"File_size_Error"));
    
            }
        } else {
            // echo "Invalid file extension. Only JPG, JPEG, and PNG files are allowed.";
            echo json_encode(array("status"=>"Invalid_file_extension"));
        }
    }else{
    
        $sqli_update = "UPDATE `posts` SET
         `post_details` = '$post_details',
         `post_photo` = '$old_image'
          where `post_id` = $post_id";
       if($query_update = mysqli_query($conn,$sqli_update))
       {
           echo json_encode(array("status"=>"success"));
       }else{
          echo json_encode(array("status"=>"Faild"));
        //
           echo  $sqli_update;
    
       }
     
    }

}




if(isset($_GET['editProfile'])){

    $user_name = $_POST['user_name'];
    $full_name = $_POST['full_name'];
    $department = $_POST['department'];
    $user_email = $_POST['user_email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
   
    $user_id = $_POST['user_id'];
    
    // echo json_encode(array("status"=>"success"));

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        
    
        // File properties
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
    
        // Get the file extension
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
        // Define allowed file extensions
        $allowed_extensions = array('jpg','jpeg', 'png','ico');
        // Define the maximum file size in bytes (e.g., 1MB = 1048576 bytes , 2MB = 2097152 bytes)
        $max_file_size = 1048576; // 1MB
       
    
        // Check if the file has a valid extension
        if (in_array($file_ext, $allowed_extensions)) {
            // Check if the file size is within the allowed limit
            if ($file_size <= $max_file_size) {
            // Check if there are no errors during the upload
            if ($file_error === 0) {
                // Specify the directory where you want to save the uploaded file
                $upload_directory = '../../uploads/users/';
                $new_file_name = mysqli_real_escape_string($conn, $file_name);
    // Update data into db
        $sqli_update = "UPDATE `users` SET  
         `user_name` = '$user_name',
         `full_name` = '$full_name',
         `email` = '$user_email',
         `address` = '$address',
         `department` = '$department',
         `phone` = '$phone',
         `password` = '$password',
         `user_image` = '$new_file_name'
          where `user_id` = $user_id";
        if($query_update = mysqli_query($conn,$sqli_update))
        {
          
            // if (file_exists($upload_directory . $old_image)) {
            //     // echo "File already exists.";
            //     //  echo json_encode(array("massege"=>"File already exists","status"=>"success"));
            //     // unlink($file);
            //     unlink($upload_directory . $old_image);
            //     move_uploaded_file($file_tmp, $upload_directory . $file_name);
    
            //     echo json_encode(array("status"=>"success"));
            // } else {
                // Move the temporary file to the desired location
                move_uploaded_file($file_tmp, $upload_directory . $file_name);
    
                 echo json_encode(array("status"=>"success"));
        // }
    
    
        }else{
            echo  $sqli_update;
            echo json_encode(array("status"=>"Faild"));
        }
    
     
            } else {
                echo json_encode(array("status"=>"Uplaoding_Error"));
            } 
        } else {
                // echo "File size exceeds the maximum limit of " . $max_file_size . " bytes.";
                echo json_encode(array("status"=>"File_size_Error"));
    
            }
        } else {
            // echo "Invalid file extension. Only JPG, JPEG, and PNG files are allowed.";
            echo json_encode(array("status"=>"Invalid_file_extension"));
        }
    }else{
    
        $sqli_update = "UPDATE `users` SET  
         `user_name` = '$user_name',
         `full_name` = '$full_name',
         `email` = '$user_email',
         `address` = '$address',
         `department` = '$department',
         `phone` = '$phone',
         `password` = '$password'
        
          where `user_id` = $user_id";
       if($query_update = mysqli_query($conn,$sqli_update))
       {
           echo json_encode(array("status"=>"success"));
       }else{
          echo json_encode(array("status"=>"Faild"));
        //
          // echo  $sqli_update;
    
       }
     
    }



}


// make a report


if (isset($_GET['reportadd'])) {
    
    $user_id = filterRequest("user_id"); //requierd
    $post_id = filterRequest("post_id");//requierd
    $report_details = filterRequest("report_details");//requierd
    // $report_date = filterRequest("report_date");//requierd

            // insert into db
            $sql_check = "SELECT * FROM `reports` where
            `reporttb_post_id` = '$post_id' and `report_details` = '$report_details' and `reporttb_user_id` = '$user_id' and `report_del` = 0";
        $query_check = mysqli_query($conn,$sql_check);
        if(mysqli_num_rows($query_check)){
        
           echo json_encode(array("status"=>"Exist"));
        }else{
        
            $sqli_insert = "insert into reports(`reporttb_post_id`,`report_details`,`reporttb_user_id`,`report_date`) 
            values ('$post_id','$report_details','$user_id','{$date}')";
           if($query_insert = mysqli_query($conn,$sqli_insert))
           {
            // echo $sqli_insert;
            echo json_encode(array("status"=>"success"));
           }else{
              echo json_encode(array("status"=>"Faild"));
            //  echo $sqli_insert;
           }
        }
    
}




// add Reaction 

if(isset($_GET['reaction'])){

$user_id = filterRequest("user_id");
$post_id = filterRequest("post_id");
// status should be 1 or 2
$status = filterRequest("status");



$sql_check = "SELECT * FROM like_posts where `liketb_user_id` = '$user_id' and `liketb_post_id` = '$post_id'";
$query_check = mysqli_query($conn,$sql_check);
if(mysqli_num_rows($query_check)){

    // echo "This user Exist";
    echo json_encode(array("status"=>"Exist"));
}else{

    $sqli_insert = "insert into like_posts (`liketb_user_id`,`liketb_post_id`,`like_status`) 
    values ('$user_id','$post_id','$status')";
    if($query_insert = mysqli_query($conn,$sqli_insert))
    {
        // echo " Data Inserted";
        echo json_encode(array("status"=>"success"));
    }else{
        //echo  $sqli_insert;
        echo json_encode(array("status"=>"Faild"));
    }

}

}



if(isset($_GET['viewposts'])){
    $data = array();

$sql = "SELECT * FROM `posts`p,`users` u  WHERE p.user_id = u.user_id and `post_del` = 0 and  `post_status` = 0 ORDER by `post_id` DESC";
$query = mysqli_query($conn,$sql);
if(mysqli_num_rows($query)){

while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;
}
  echo json_encode(array("data"=>$data));

    // print_r($data);
}else{

      echo  json_encode(array("status"=>"Faild"));
}

}




if(isset($_GET['showreport'])){
    $data = array();
    $user_id = $_POST['user_id'];

$sql = "SELECT * FROM `reports`r ,`posts`p where r.reporttb_post_id = p.post_id and `reporttb_user_id` = $user_id and report_del = 0  ORDER by report_id DESC";
$query = mysqli_query($conn,$sql);
if(mysqli_num_rows($query)){

while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;
}
  echo json_encode(array("data"=>$data));

    // print_r($data);
}else{

      echo  json_encode(array("status"=>"Faild"));
}

}


if(isset($_GET['deletereport'])){

    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    $sqli = "UPDATE posts SET post_del = 1 where post_id = $post_id and user_id = $user_id ";

    if($query = mysqli_query($conn,$sqli))
    {
        // echo " Data Inserted";
        echo json_encode(array("status"=>"success"));
    }else{
        //echo  $sqli_insert;
        echo json_encode(array("status"=>"Faild"));
    }
}


if (isset($_GET['countlikedpost'])) {

    $post_id = $_POST['post_id'];
    $data = array();
   
    global $conn;
    $sql = "SELECT Count(liketb_id) as c from like_posts  where like_status = 1 and  `liketb_post_id` = $post_id";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)){

      while($row = mysqli_fetch_assoc($query)){
          $data[] = $row;
      }
           echo json_encode(array("data"=>$data));
      
      }else{
      
            echo  json_encode(array("status"=>"Faild"));
      }

}


// add Comments 

if(isset($_GET['usercomment'])){

    $post_id = filterRequest("post_id");
    $user_id = filterRequest("user_id");
    $comment_details = filterRequest("comment_details");
        
        $sqli_insert = "insert into comments (`commenttb_post_id`,`commenttb_user_id`,`comment_details`) 
        values ('$post_id','$user_id','$comment_details')";
        if($query_insert = mysqli_query($conn,$sqli_insert))
        {
            // echo " Data Inserted";
            echo json_encode(array("status"=>"success"));
        }else{
            //echo  $sqli_insert;
            echo json_encode(array("status"=>"Faild"));
        }
    
    }
    
    // }



    if(isset($_GET['viewcomments'])){
        $data = array();
        $post_id = $_POST['post_id'];
    
    $sql = "SELECT * FROM `posts`p,`users`u,`comments`c WHERE c.commenttb_post_id = p.post_id and c.commenttb_post_id = $post_id  and c.commenttb_user_id = u.user_id and `comment_del` = 0 ORDER by `comment_id` DESC";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query)){
    
    while($row = mysqli_fetch_assoc($query)){
        $data[] = $row;
    }
      echo json_encode(array("data"=>$data));
    
        // print_r($data);
    }else{
    
          echo  json_encode(array("status"=>"Faild"));
    }
    
    }
    
    




   if(isset($_GET['likedpost'])){

    $data = array();
    $user_id = $_POST['user_id'];

     $sql = "SELECT * FROM `like_posts`l,`posts`p,`users`u where p.user_id = u.user_id and l.liketb_post_id = p.post_id and l.liketb_user_id = $user_id order by liketb_id DESC";
     $query = mysqli_query($conn,$sql);
     if(mysqli_num_rows($query)){

    while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;
    }
    echo json_encode(array("data"=>$data));

    // print_r($data);
    }else{

      echo  json_encode(array("status"=>"Faild"));
   }

    }





    if(isset($_GET['myposts'])){

        $data = array();
        $user_id = $_POST['user_id'];
    
         $sql = "SELECT * FROM posts where user_id = $user_id and post_del = 0 order by post_id DESC";
         $query = mysqli_query($conn,$sql);
         if(mysqli_num_rows($query)){
    
        while($row = mysqli_fetch_assoc($query)){
        $data[] = $row;
        }
        echo json_encode(array("data"=>$data));
    
        // print_r($data);
        }else{
    
          echo  json_encode(array("status"=>"Faild"));
       }
    
        }
    
    






































?>