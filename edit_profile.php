<?php
session_start();

include_once("includes/connection.php");

if(!isset($_SESSION['user_email'])){
	header("location:index.php");
}
else {

?>

<!DOCTYPE html>
<html>
  <head>
      <title>Welcome User!</title>
	  
	  <link rel="stylesheet" href="styles/home_style.css">
	  
	  <style>
	  input[type='file']{width:180px;}
	  
	  </style>
	  
	  </head>
	  
<body>
<div class="container">
 </div>
     <div id="header_wrapper"> 
	     <div id="header">
		     <ul id="menu">
			    <li><a href="home.php">Home</a></li>
				<li><a href="members.php">Members</a></li>
				<strong>Topics:</strong>
				<?php
				 
				 $get_topics="select * from topics";
				 $run=mysqli_query($con,$get_topics);
				 
				 while($row=mysqli_fetch_array($run)){
					 
					 $topic_id=$row['topic_id'];
					 $topic_title=$row['topic_title'];
					 
			     echo"<li><a href='topic.php?topic=$topic_id'>$topic_title</a></li>";
				 }
				  ?>				 
				
				
			 
			 </ul>
			 <form method="get" action="results.php" id="fm1">
			     <input type="text" name="user_query" placeholder="Seach a Topic"/>
				 <input type="submit" name="search" value="search"/>
				 
				 </form>
				 </div>
		 </div>
		     <div class="content">
			    <div id="user_timeline">
				  <div id="user_details">
				  <?php
				  $user=$_SESSION['user_email'];
				  $get_user="select * from user where u_mail='$user'";
				  $run_user=mysqli_query($con,$get_user);
				  $row=mysqli_fetch_array($run_user);
				  $user_id=$row['id'];
				  $user_name=$row['u_name'];
				  $user_pass=$row['u_pass'];
				  $user_email=$row['u_mail'];
				  $user_gender=$row['u_gender'];
				  $user_country=$row['u_country'];
				  $user_image=$row['u_image'];
				  $register_date=$row['u_reg_date'];
				  $last_login=$row['u_last_login'];
				  
				  
				  
				  echo"<center>
				      <img src='user/user_images/$user_image' width='200'
					  height='200'/>
					  <div id='user_mention'>
					  <p><strong>Name:</strong>$user_name</p>
					  <p><strong>Country:</strong>$user_country</p>
					  <p><strong>Last Login:</strong>$register_date</p>
					  <p><strong>Member Since:</strong>$last_login</p>
					  
					  <p><a href='my_messages.php?u_id=$user_id'>Messages(2)</a></p>
					  <p><a href='my_posts.php?u_id=$user_id'>Posts(3)</a></p>
					  <p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
					  <p><a href='logout.php'>Logout</a></p>
					  </div>
					  </center>
					  ";
				 
				  
				  ?>
				  </div>
				  </div>
				<div id="content_timeline">
				   <h2>Edit Your Profile:</h2>
				   <form action="" method="post" id="fm2" enctype="multipart/form-data">
		     
		     <table align="center" width="600px">
		     
			 
			 <tr>
			     <td><strong>Name:</strong></td>
				 <td><input type="text" name="u_name" value="<?php echo $user_name;?>" required></td>
		     </tr>
             <tr>
			     <td><strong>Password:</strong></td>
				 <td><input type="password" name="u_pass" value="<?php echo $user_pass;?>" required></td>
		     </tr>
			 <tr>
			     <td><strong>Email:</strong></td>
				 <td><input type="email" name="u_mail" value="<?php echo $user_email;?>" required></td>
		     </tr>
			 <tr>
			     <td><strong>Country:</strong></td>
				 <td><input type="text" name="u_country" value="<?php echo $user_country;?>" required></td>
		     </tr>
			 <tr>
			     <td><strong>Gender:</strong></td>
				 <td><select name="u_gender" value="<?php echo $user_gender;?>" disabled>
				         <option>Male</option>
						 <option>Female</option>
						 <option>Others</option>
						 </select>
						 </td>
		     </tr>
			 
			 <tr>
			     <td><strong>Photo:</strong></td>
				 <td><input type="file" name="u_image"  required></td>
		     </tr
			 
			 <br/>
			 <tr align="center">
			 <td colspan="6"><input type="submit" name="update" value="Update"></td>
			 </tr>
			 
		   </table>
		   </form>
		   
<?php
    if(isset($_POST['update'])){
		
		$u_name = $_POST['u_name'];
		$u_pass = $_POST['u_pass'];
		$u_email = $_POST['u_mail'];
		$u_image = $_FILES['u_image']['name'];
		$image_tmp=$_FILES['u_image']['tmp_name'];
		
		move_uploaded_file($image_tmp,"user/user_images/$u_image");
		
		$update="update user set u_name='$u_name' ,u_pass ='$u_pass' ,u_mail='$u_email',u_image='$u_image' where id='$user_id'";
        $run=mysqli_query($con,$update);
		
		if($run){
			
			echo"<script>alert('your profile updated!')</script>";
			
			echo"<script>window.open('home.php','_self')</script>";
			
		}

		}
		
				   
	?>			     
</div>
</div>				
</body>
</html>

<?php } ?>