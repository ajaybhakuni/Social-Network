<?php

include_once("includes/connection.php");

if(isset($_POST['sign_up'])){
   
   $name=$_POST['u_name'];   
   $pass=$_POST['u_pass'];  
   $email=$_POST['u_mail'];  
   $country=$_POST['u_country'];  
   $gender=$_POST['u_gender'];  
   $birthday=$_POST['u_birthday'];  
   $status="unverified";
   $posts="no";
   $ver_code=mt_rand();
   
    if(strlen($pass)<8){
	   echo"<script>alert('Password Should Be Minimum 8 Characters')</script>";
	   exit();
   }
   $check_email="select * from user where u_mail='$email'";
   $run=mysqli_query($con,$check_email);
   
   $check=mysqli_num_rows($run);
   if($check==1){
	   
	  echo"<script>alert('Email Already Registered')</script>";
	   exit();
   }
   
   $insert="insert into user(u_name,u_pass,u_mail,u_country,u_gender,u_birthday,u_image,u_reg_date,u_last_login,status,ver_code,posts)
   values('$name','$pass','$email','$country','$gender','$birthday','tds.png',NOW(),NOW(),'$status','$ver_code','$posts')";
   
   $query=mysqli_query($con,$insert);
   
   if($query){
	   $_SESSION['user_email']=$email;
	   
	   echo"<h3 style='width:300px; text-align:justify'>Hello!, $name Congrats ,REGISTRATION IS ALMOST COMPLETE,PLEASE CHECK YOUR EMAIL FOR FINAL VERIFICATION.</h3>";
   }
   else{
	   echo"Registration Failed ,Try Again";
   }
   
    $to=$email;
   $subject="Verify Your Email Address";
   $message="
   <html>
      Hello<strong>$name</strong> You Have Just Created Account on
	  The Desi Shows,Please Verify Your Email By Clicking Below Link:
	  
	  < a href='http://thedesishows.tk/verify.php?code=$ver_code'>Click To Verify Your Email</a><br/>
      <strong>Thank You For Creating Account</strong>
   
   </html>
   ";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <webmaster@example.com>' . "\r\n";

mail($to,$subject,$message,$headers);

   
    
   }
   
   
  

?>