


<table width="700" align="center" style="background:orange;padding:10px;margin:2px;">

					 <tr>
					    <th>Receiver</th>
						<th>Subject</th>
						<th>Date</th>
						<th>Reply</th>
					</tr>
									  <?php
				  
				  $sel_msg="select * from messages where sender='$user_id' ORDER by 1 DESC";
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
				  
				  $get_receiver="select * from user where id='$msg_receiver'";
				  $run_receiver=mysqli_query($con,$get_receiver);
				  $row=mysqli_fetch_array($run_receiver);
				  
				  $receiver_name=$row['u_name'];
				  
	
				 ?>
					<tr align="center">
					       <td>
						   <a href="user_profile.php?u_id=<?php echo $msg_receiver;?>" target="blank">
						   <?php echo $receiver_name;?></a></td>
					    <td><a href="inbox.php?msg_id=<?php echo $msg_id;?>"><?php echo $msg_sub;?></td>
						<td><?php echo $msg_date;?></td>
						<td><a href="inbox.php?msg_id=<?php echo $msg_id;?>">View Reply</a></td>
						
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
						       
							 ?>
							 