<?php
session_start();
include_once("includes/connection.php");

?>

<!DOCTYPE html>
<html>
    <head>
	
	<title>
	Admin Login
	</title>
	<style>
	body{padding:0; margin:0; background:orange;}
	td,table{padding:10px;}
	</style>
	</head>
	
	<body>
	<form action="admin_login.php" method="post">
	
	  <table align="center" bgcolor="skyblue" width="500">
	      <tr align="center"> 
		       <td colspan="3"><h2>Admin Login Here:</h2></td>
			   
		  
		  </tr>
		  
		  <tr>
		     <td align="right"><strong>Admin Email:</strong></td>
			 <td><input type="email" placeholder="Enter Your Email" name="email"></td>
		  
		  </tr>
		  
		  <tr>
		     <td align="right"><strong>Admin Password:</strong></td>
			 <td><input type="password" placeholder="Enter Your Password" name="pass"></td>
		  
		  </tr>
		  
		  <tr align="center">
		     
			 <td colspan="3"><input type="submit"  name="admin_login" value="Admin Login"></td>
		  
		  </tr>
		  
	  </table>
	  </form>
	  
	  <?php
	  
	  if(isset($_POST['admin_login'])){
	
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	
	$get_admin="SELECT * FROM admins WHERE admin_email='$email' AND admin_pass='$pass'";
	
	$run_admin=mysqli_query($con,$get_admin);
	$check_admin=mysqli_num_rows($run_admin);
	if($check_admin==1){
		$_SESSION['admin_email']=$email;
		echo "<script>window.open('index.php','_self')</script>";
		
	}
	else{
		echo "<script>alert('Incorrect Details,Try again')</script>";
		
	}
	
	
	
}
	  
	  ?>
	</body>
	</html>