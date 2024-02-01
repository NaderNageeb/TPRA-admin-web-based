<?php 
date_default_timezone_set("Africa/Khartoum");

$conn = mysqli_connect("localhost", "root", "", "tpra_db");
mysqli_set_charset($conn, 'UTF8');
mysqli_query($conn, "SET NAMES 'utf8'");
mysqli_query($conn, 'SET CHARACTER SET utf8');

if (!$conn) {
	echo "Error," . mysqli_connect_error($conn);
	die;
}else{
	// echo "good connection";
}
global $conn;
//========================= Global Variables =======================//
$alert = '';
$star = "<font style='color:#900;'> * </font>";
//=============Session===============//
session_start();
$currentDate = date('Y-m-d');
function alerts($type, $message)
{
	switch ($type) {
		case 1: {
				$res = '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>' . $message . '</div>';
				break;
			} //Green

		case 2: {
				$res = '<div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>' . $message . '</div>';
				break;
			} //Yellow
		case 3: {
				$res = '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>' . $message . '</div>';
				break;
			} //Red	
	}
	return $res;
}


function Login($user_name, $password)
{
	global $conn;

	// $password = md5($password);

	$sql = "SELECT * FROM `users` where `user_name` = '{$user_name}' and `password` = '{$password}' and `user_type` = 1 and  `user_del` = 0 ";

	if ($query = mysqli_query($conn, $sql)) {
		if (mysqli_num_rows($query)) {
			$row = mysqli_fetch_array($query);
			//echo $sql;die;
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_type'] = $row['user_type'];
				
		header("location:./index.php");
		
		} else {
			header("location:./login.php?error");
		}
	} else {
		echo $sql;
		die;
	}
}





function Add_user($user_name,$email,$phone,$add,$full_name,$user_type,$department,$password){
	global $conn ;
	
	$query_check = "SELECT * FROM users where user_name = '$user_name' and user_type = '$user_type' and user_del = 0";
		if($query_check = mysqli_query($conn,$query_check))
		If(mysqli_num_rows($query_check))
		{
			return 1;
		//echo "<script>alert('This User Exists');window.location = '/Kush_Online_Store/add_user.php';</script>";
		}
	 $query = "insert into users(user_name,email,phone,address,department,full_name,password,user_type)
		 values ('$user_name','$email','$phone','$add','$department','$full_name','$password','$user_type')";
		 if(mysqli_query($conn,$query)){
		return 2;	 
	//  echo "<script>alert('User Added Successfully');window.location = '/Kush_Online_Store/manage_users.php';</script>";
		 }else{
			return 3 ;
			// echo $query;
	// echo "<script>alert('User Added Faild');window.location = '/Kush_Online_Store/add_user.php';</script>";
		 }
		 
	}


  function Get_users(){

	global $conn ;

   $sql = "SELECT * FROM `users` WHERE user_type = 0 and `user_del`  = 0 order by user_id DESC";
   if($query = mysqli_query($conn,$sql))
	{
	return $query;	
	}
   else
	{
	echo $sql;die;
	}
  }


    function User_detils($user_id){
	global $conn;
	
	 $sql = "SELECT * FROM `users` where user_id = $user_id and  user_del = 0";
	if($query = mysqli_query($conn,$sql))
		{   
		$res  = mysqli_fetch_array($query);
		return $res;	
		}
	else
		{
		echo $sql;die;
		}
	
	}
	

	function Update_user_account($user_id,$user_name,$full_name,$email,$phone,$add,$user_type,$department,$password){
		global $conn;
	
	   $sql = "UPDATE users SET `user_name` = '$user_name',`full_name`= '$full_name',`Phone` = '$phone',`address` = '$add',`email`= '$email',
		`password` = '$password' , `department` = '$department',`user_type` = '$user_type' where `user_id` = $user_id ";
		 if($query = mysqli_query($conn,$sql)){
		//echo '<div class="alert alert-success alert-dismissible fade in" role="alert" style="text-align:center"> Updating Successfully </div>';
	    // echo "<script>alert('Updating Successfully');window.location = '/Kush_Online_Store/manage_users.php';</script>";
	    return 1;

		 }else{
			return 2;
			echo $sql;
	        //  echo "<script>alert('Updating Faild');window.location = '/Kush_Online_Store/manage_users.php';</script>";
			//  echo $sql;
			// echo "Error Updating : " . $conn->error;
		 }
	
	
	}
	
	function User_delete($user_id) {

		global $conn;
        $sql = "UPDATE `users` SET `user_del` = 1 where user_id = $user_id";
		if($query = mysqli_query($conn,$sql)){
         return 1;
		}else{
			return 2;
		}

	}

	function Post_delete($post_id){

		global $conn;
        $sql = "UPDATE `posts` SET `post_del` = 1 where post_id  = $post_id";
		if($query = mysqli_query($conn,$sql)){
         return 1;
		}else{
			return 2;
		}

	}

	function User_active($user_id) {

		global $conn;
        $sql = "UPDATE `users` SET `status` = 0 where user_id = $user_id";
		if($query = mysqli_query($conn,$sql)){
         return 1;
		}else{
			return 2;
		}


	}

	function User_disactive($user_id){

		global $conn;
        $sql = "UPDATE `users` SET `status` = 1 where user_id = $user_id";
		if($query = mysqli_query($conn,$sql)){
         return 1;
		}else{
			return 2;
		}

	}

	function Report_update($report_id){

		global $conn;
        $sql = "UPDATE `reports` SET `report_action` = 1 where report_id  = $report_id";
		if($query = mysqli_query($conn,$sql)){
         return 1;
		}else{
			return 2;
		}

	}


	function Get_posts(){

		global $conn ;
	
	   $sql = "SELECT * FROM `users`u,`posts`p WHERE u.user_id = p.user_id and p.post_del = 0 order by post_id DESC ";
	   if($query = mysqli_query($conn,$sql))
		{
		return $query;	
		}
	   else
		{
		echo $sql;die;
		}
	  }
	

	  function Post_active($post_id) {

		global $conn;
        $sql = "UPDATE `posts` SET `post_status` = 0 where post_id = $post_id";
		if($query = mysqli_query($conn,$sql)){
         return 1;
		}else{
		 return 2;
		}


	}

	function Post_disactive($post_id){

		global $conn;
        $sql = "UPDATE `posts` SET `post_status` = 1 where post_id = $post_id";
		if($query = mysqli_query($conn,$sql)){
         return 1;
		}else{
			return 2;
		}


	}

	function Get_reports(){

		global $conn ;
	
	   $sql = "SELECT * FROM `reports`r,`users`u,`posts`p where u.user_id = reporttb_user_id and p.post_id = r.reporttb_post_id and report_del = 0 order by report_id DESC";
	   if($query = mysqli_query($conn,$sql))
		{
		return $query;	
		}
	   else
		{
		echo $sql;die;
		}
	  }
	
// dashboard function

function DashboardCount($coulom_id,$table,$delname){
	global $conn;
	$sql = "SELECT COUNT($coulom_id) As c from $table where `$delname` = 0 ";
    $query = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($query);
    $num_rows = $values['c'];
    return $num_rows;
}


function DashboarduserCount($coulom_id,$table,$delname,$status){
	global $conn;
	$sql = "SELECT COUNT($coulom_id) As c from $table where `status` = $status  and `$delname` = 0 and `user_type` = 0 ";
    $query = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($query);
    $num_rows = $values['c'];
    return $num_rows;
}

// dashboard function end;

// system Report 

function Search($status,$date){
	global $conn;

   if($status !='' && $date !=''){
	$sql = "SELECT * FROM `posts`p,`users`u where p.user_id = u.user_id and p.post_status = $status and p.post_date = '{$date}' and p.post_del = 0 ";
   }
   if($status !='' && $date ==''){
	$sql = "SELECT * FROM `posts`p,`users`u where p.user_id = u.user_id and p.post_status = $status and p.post_del = 0 ";	
   }
   if($status =='' && $date !=''){
	$sql = "SELECT * FROM `posts`p,`users`u where p.user_id = u.user_id and p.post_date = '{$date}' and p.post_del = 0 ";	
   }

	if($query = mysqli_query($conn,$sql))
	{
	return $query;	
	}
   else
	{
	echo $sql;die;
	}


}