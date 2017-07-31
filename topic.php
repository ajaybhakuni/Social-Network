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
				  
				  
				  
				  echo"<center>
				      <img src='user/user_images/$user_image' width='200'
					  height='200'/>
					  <div id='user_mention'>
					  <p><strong>Name:</strong>$user_name</p>
					  <p><strong>Country:</strong>$user_country</p>
					  <p><strong>Last Login:</strong>$register_date</p>
					  <p><strong>Member Since:</strong>$last_login</p>
					  
					  <p><a href='my_messages.php'>Messages(2)</a></p>
					  <p><a href='my_posts.php'>Posts(3)</a></p>
					  <p><a href='edit_profile.php'>Edit My Account</a></p>
					  <p><a href='logout.php'>Logout</a></p>
					  </div>
					  </center>
					  ";
				 
				  
				  ?>
				  </div>
				  </div>
				<div id="content_timeline">
				   <form action="home.php?id=<?php echo $user_id;?>" method="post" id="fm2">
				   <h2> Lets Discuss Bollywood</h2>
				   <input type="text" name="title" placeholder="Write A Title" size=82" required/><br/>
				   <textarea cols="83" rows="4" name="content">Write Description..</textarea><br/>
				   <select name="topic">
				      <option>Select Topic</option>
					  
				   <?php getTopics();?>
				   </select>
				   <input type="submit" name="submit" value="Post To Timeline">
				   </form>
				   <?php insertPost();?>

				   <h3>All Posts In this Topic</h3>
				   <?php get_cats();?>
				     
</div>
</div>				
</body>
</html>

<?php } ?>