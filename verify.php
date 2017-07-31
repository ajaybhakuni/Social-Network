<?php

include_once("includes/connection.php");

if(isset($_GET['code'])){
	
	$get_code=$_GET['code'];
	
	$get_user="select * from user where ver_code='$get_code'";
	
	$run_user=mysqli_query($con,$get_user);
	
	$check_user=mysqli_num_rows($run_user);
	
	$row_user=mysqli_fetch_array($run_user);
	
	$user_id=$row_user['id'];
	
	if($check_user==1){
		$update_user="update user set status='ok' where id='$user_id'";
		$run_update=mysqli_query($con,$update_user);
		
		echo"<h2>Thanks Your Email Is Verified</h2>Please Login To Our Website";
	}
	else{
		
		echo"Sorry Verify Your Email First";
	}
}

?>