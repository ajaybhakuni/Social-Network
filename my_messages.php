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
				
                  if(isset($_GET['u_id'])){
				  $u_id=$_GET['u_id'];  
				  $sel="select * from user where id='$u_id'";
				  $run=mysqli_query($con,$sel);
				  $row=mysqli_fetch_array($run);
				  
				  $user_name=$row['u_name'];
				  $user_image=$row['u_image'];
				  $reg_date=$row['u_reg_date'];
				  }
				  
				  ?>
				  
				  <h2>Send Message To <span style='color:red;'><?php echo $user_name;?>
				  </span></h2>
				  <form method="post" action="my_messages.php?u_id=<?php echo $u_id;?>" id="fm2">
			     <input type="text" name="msg_title" placeholder="Message Subject..." size="50"/>
				 <textarea name="msg" cols="50" rows="5" placeholder="Message Topic..."/></textarea>
				 <input type="submit" name="message" value="Send Message"/>
				 
				 </form><br/>
				 
				 <img style="border:2px solid blue; border-radius:5px;" src="user/user_images/<?php echo $user_image;?>" 
				 width="100" height="100"/>
				 <p><strong><?php echo $user_name;?></strong> is member of this Network Since:
				 <?php echo $reg_date;?></p>
				  

	
</div>

<?php

if(isset($_POST['message'])){
	$msg_title=$_POST['msg_title'];
	$msg=$_POST['msg'];
	
	$insert="insert into messages(sender,receiver,msg_sub,msg_topic,reply,status,msg_date) values ('$user_id','$u_id',
	     '$msg_title','$msg','no_reply','unread',NOW())";
		 
		 $run_insert=mysqli_query($con,$insert);
		 
		 if($run_insert){
			 
			echo"<center><h2>Message Was Sent To '$user_name'
			 successfully</h2></center>";
		 }
		 else{
			 echo"<center><h2>Message Was Not Sent...!</h2></center>";
		 }
}

?>
</div>	
			
</body>
</html>

<?php } ?>