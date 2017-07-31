
<table align="center" width="800"  bgcolor="skyblue" style="margin-top:11px">

    <tr bgcolor="pink" border="1" >
	   <th>S.N</th>
	   <th>Title</th>
	   <th>Author</th>
	   <th>Date</th>
	   <th>Delete</th>
	   <th>Edit</th>
	
	
	</tr>
	
	<?php 
	include_once("includes/connection.php");
	$sel_posts="select * from posts ORDER by 1 DESC";
	$run_posts=mysqli_query($con,$sel_posts);
	
	$i=0;
	while($row_posts=mysqli_fetch_array($run_posts)){
		
		$post_id=$row_posts['post_id'];
		$user_id=$row_posts['user_id'];
		$post_title=$row_posts['post_title'];
		$post_date=$row_posts['post_date'];
	
	     $i++; 
	        $sel_user="select * from user where id='$user_id'";
		    $run_user=mysqli_query($con,$sel_user);
	 	    while($row_user=mysqli_fetch_array($run_user)){
			
             $user_name=$row_user['u_name'];			
		
			
	?>
	
	<tr align="center">
	    <td><?php echo $i;?></td>
		<td><?php echo $post_title;?></td>
		<td><?php echo $user_name;?></td>
		<td><?php echo $post_date;?></td>
        <td><a href="index.php?view_posts&delete=<?php echo $post_id;?>">Delete</a></td>
		<td><a href="index.php?view_posts&edit=<?php echo $post_id;?>">Edit</a></td>
	</tr>
	<?php }}?>
	
</table>

<?php

  	if(isset($_GET['edit'])){
	$edit_id=$_GET['edit'];	
	$sel_posts="select * from posts where post_id='$edit_id'";
	$run_posts=mysqli_query($con,$sel_posts);
	
	
	while($row_posts=mysqli_fetch_array($run_posts)); {
		
		$post_new_id=$row_posts['post_id'];
		$post_title=$row_posts['post_title'];
		$post_content=$row_posts['post_content'];
		
	
?>

<h2 style="padding:5px;">Update Your Post</h2>

<form action="" method="post" id="fm2" enctype="multipart/form-data">
		     
		           <input type="text" name="title" value="<?php echo $post_title;?>" size="82"/><br/>
				   <textarea cols="83" rows="4" name="content"><?php echo $post_content;?></textarea><br/>
				   <select name="topic">
				      <option>Select Topic</option>
					  
				   <?php getTopics();?>
				   </select>
				   <input type="submit" name="update" value="Update Post">
				   </form>

		   </form>
		   
	
		   
<?php
    if(isset($_POST['update'])){
		
		$title = $_POST['title'];
		$content = $_POST['content'];
		$topic = $_POST['topic'];
	
		echo $update="update posts set post_title='$title' ,post_content ='$content' ,topic_id='$topic',post_date=NOW() where post_id='$post_id'";
        $run=mysqli_query($con,$update) or mysqli_error();
		
		if($run){
			
			echo"<script>alert('Post Is updated!')</script>";
			
			echo"<script>window.open('index.php?view_posts','_self')</script>";
			
		}

		}
		
    if(isset($_GET['delete'])){
	$delete_id=$_GET['delete'];	
	$delete="delete from posts where post_id='$delete_id'";
	$run_delete=mysqli_query($con,$delete);
	
	if($run_delete){
			
			echo"<script>alert('Post Is deleted!')</script>";
			
			echo"<script>window.open('index.php?view_posts','_self')</script>";
			
		}

		}
		
	}
				   
	?>			     

<?php }?>
