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
				  $user_country=$row['u_country'];
				  $user_image=$row['u_image'];
				  $register_date=$row['u_reg_date'];
				  $last_login=$row['u_last_login'];
				  
				  $user_posts="select * from posts where user_id='$user_id'";
				  $run_posts=mysqli_query($con,$user_posts);
				  $posts=mysqli_num_rows($run_posts);
				  
				  $sel_msg="select * from messages where receiver='$user_id' AND status='unread'";
				  $run_msg=mysqli_query($con,$sel_msg);
				  $count_msg=mysqli_num_rows($run_msg);
				  
				  echo"<center>
				      <img src='user/user_images/$user_image' width='200'
					  height='200'/>
					  <div id='user_mention'>
					  <p><strong>Name:</strong>$user_name</p>
					  <p><strong>Country:</strong>$user_country</p>
					  <p><strong>Last Login:</strong>$register_date</p>
					  <p><strong>Member Since:</strong>$last_login</p>
					  
					  <p><a href='inbox.php?u_id=$user_id'>Messages($count_msg)</a></p>
					  <p><a href='my_posts.php?u_id=$user_id'>Posts($posts)</a></p>
					  <p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
					  <p><a href='logout.php'>Logout</a></p>
					  </div>
					  </center>
					  ";
				 
				  
				  ?>
				  </div>
				  </div>
				<div id="content_timeline">
				
				<?php
				
				  if(isset($_GET['post_id'])){
					  
					  $get_id=$_GET['post_id'];
					  $get_post="select * from posts where post_id='$get_id'";
					  $run_post=mysqli_query($con,$get_post);
					  $row=mysqli_fetch_array($run_post);
					  
					  $post_title=$row['post_title'];
					  $post_con=$row['post_content'];
					  
				  }
				  
				  
				
				?>
				   <form action="" method="post" id="fm2">
				   <h2> Edit Your Post</h2>
				   <input type="text" name="title" value="<?php echo $post_title;?> size="82" required/><br/>
				   <textarea cols="83" rows="4" name="content" placeholder="Write Description.."><?php echo $post_con;?></textarea><br/>
				   <select name="topic">
				      <option>Select Topic</option>
					  
				   <?php getTopics();?>
				   </select>
				   <input type="submit" name="update" value="Update Your Post">
				   </form>
				   
				  <?php
				  
				   if(isset($_POST['update'])){
					   
					   $title=$_POST['title'];
					   $content=$_POST['content'];
					   $topic=$_POST['topic'];
					   $update_post= "update posts set post_title='$title' ,post_content='$content' , topic_id='$topic' where post_id='$get_id'";
				       $run_update=mysqli_query($con,$update_post);
					   
					   if($run_update){
						   
						  echo "<script>alert('Your Post Has Been Updates')</script>";
		                  echo "<script>window.open('home.php','_self')</script>";
	

}}
				   
				     ?>
</div>
</div>				
</body>
</html>

<?php } ?>