<?php
session_start();


include_once("includes/connection.php");
if(isset($_POST['login'])){
	
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	
	$user="SELECT * FROM user WHERE u_mail='$email' AND u_pass='$pass' AND status='ok'";
	
	$query=mysqli_query($con,$user);
	echo $check=mysqli_num_rows($query);
	if($check==1){
		$_SESSION['user_email']=$email;
		echo "<script>window.open('home.php','_self')</script>";
		
	}
	else{
		echo "<script>alert('Incorrect Details,Try again')</script>";
		
	}
	
	
	
}

?>