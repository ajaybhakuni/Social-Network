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
					  
					  <p><a href='inbox.php?inbox&u_id=$user_id'>Messages($count_msg)</a></p>
					  <p><a href='my_posts.php?u_id=$user_id'>Posts($posts)</a></p>
					  <p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
					  <p><a href='logout.php'>Logout</a></p>
					  </div>
					  </center>
					  ";
				 
				  
				  ?>
				  </div>
				  </div>
				  
				  
				<div id="msg">
				<p align="center">
				<a href="inbox.php?inbox">My Inbox</a> ||
				<a href="inbox.php?sent">Sent Items</a>
				</p>
				
				<?php 
				if(isset($_GET['sent'])){
					include("sent.php");
				
				}
				?>
				
				<?php if(isset($_GET['inbox'])){?>
				 <table width="700" align="center" style="background:orange;padding:10px;margin:2px;">

					 <tr>
					    <th>Sender</th>
						<th>Subject</th>
						<th>Date</th>
						<th>Reply</th>
					</tr>
									  <?php
				  
				  $sel_msg="select * from messages where receiver='$user_id' AND status='unread'";
				  $run_msg=mysqli_query($con,$sel_msg);
				  $count_msg=mysqli_num_rows($run_msg);
				  
				  while($row_msg=mysqli_fetch_array($run_msg))
				  {
					  $msg_id=$row_msg['msg_id'];
					  $msg_receiver=$row_msg['receiver'];
					  $msg_sender=$row_msg['sender'];
					  $msg_sub=$row_msg['msg_sub'];
					  $msg_topic=$row_msg['msg_topic'];
					  $msg_date=$row_msg['msg_date'];
				  
				  $get_sender="select * from user where id='$msg_sender'";
				  $run_sender=mysqli_query($con,$get_sender);
				  $row=mysqli_fetch_array($run_sender);
				  
				  $sender_name=$row['u_name'];
				  
	
				 ?>
					<tr align="center">
					       <td>
						   <a href="user_profile.php?u_id=<?php echo $msg_sender;?>" target="blank">
						   <?php echo $sender_name;?></a></td>
					    <td><a href="inbox.php?msg_id=<?php echo $msg_id;?>"><?php echo $msg_sub;?></td>
						<td><?php echo $msg_date;?></td>
						<td><a href="inbox.php?msg_id=<?php echo $msg_id;?>">Reply</a></td>
						
					</tr>

				  <?php }?> 					
                      				     </table> 
					 
					 <?php 
					    if(isset($_GET['msg_id'])){
							$get_id=$_GET['msg_id'];
							
						     $sel_message="select * from messages where msg_id='$get_id'";
							 $run_message=mysqli_query($con,$sel_message);
							 $row_message=mysqli_fetch_array($run_message);
							 $msg_subject=$row_message['msg_sub'];
							 $msg_topic=$row_message['msg_topic'];
							 $reply_content=$row_message['reply'];
							 
							 
							 $update_unread="update messages set status='read' where msg_id='$get_id'";
							 $run_unread=mysqli_query($con,$update_unread);
							 
							 echo "
							 <center>
							 <br/><hr>
							 <h2>$msg_subject</h2>

							 <p><b>Message:</b>$msg_topic</p>
							     <p><b>MY Reply</b>$reply_content</p>
				                 <form action='' method='post' id='fm2'>
							    <textarea cols='30'rows='5' name='reply'></textarea>
								<input type='submit' name='msg_reply' value='Reply To This'>
								</form>
							 </center>
							 ";
					
						
						}
						   if(isset($_POST['msg_reply'])){
							   $user_reply=$_POST['reply'];
							   
							   if($reply_content!='no_reply'){
								  echo"<center><h2>Message Was Already Replied!</center></h2>";
						        exit();
							   }
							   else{
								   
							   $update_msg="update messages set reply='$user_reply' where msg_id='$get_id'";
						   
						      $run_update=mysqli_query($con,$update_msg);
							   }
							  echo"<center><h2>Message Was Replied!</center></h2>";
						   } 
				}  
							 ?>
							 
				  </div>
				  
</div>	
			
</body>
</html>

<?php } ?>