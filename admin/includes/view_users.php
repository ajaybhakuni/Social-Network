
<table align="center" width="800"  bgcolor="skyblue" style="margin-top:11px">

    <tr bgcolor="pink" border="1" >
	   <th>S.N</th>
	   <th>Name</th>
	   <th>Email</th>
	   <th>Image</th>
	   <th>Country</th>
	   <th>Delete</th>
	   <th>Edit</th>
	
	
	</tr>
	
	<?php 
	include_once("includes/connection.php");
	$sel_users="select * from user ORDER by 1 DESC";
	$run_users=mysqli_query($con,$sel_users);
	
	$i=0;
	while($row_users=mysqli_fetch_array($run_users)){
		
		$user_id=$row_users['id'];
		$user_name=$row_users['u_name'];
		$user_country=$row_users['u_country'];
		$user_gender=$row_users['u_gender'];
		$user_image=$row_users['u_image'];
		$user_reg_date=$row_users['u_reg_date'];
	
	$i++; 
	?>
	
	<tr align="center">
	    <td><?php echo $i;?></td>
		<td><?php echo $user_name;?></td>
		<td><?php echo $user_country;?></td>
		<td><?php echo $user_gender;?></td>
		<td><img src="../user/user_images/<?php echo $user_image;?>" width="50" height="50px"</td>
		<td><a href="delete_user.php?delete=<?php echo $user_id;?>">Delete</a></td>
		<td><a href="index.php?view_users&edit=<?php echo $user_id;?>">Edit</a></td>
	</tr>
	<?php }?>
	
</table>

<?php

  	if(isset($_GET['edit'])){
	$edit_id=$_GET['edit'];	
	$sel_users="select * from user where id='$edit_id'";
	$run_users=mysqli_query($con,$sel_users);
	
	
	$row_users=mysqli_fetch_array($run_users);
		
		$user_id=$row_users['id'];
		$user_name=$row_users['u_name'];
		$user_country=$row_users['u_country'];
		$user_gender=$row_users['u_gender'];
		$user_image=$row_users['u_image'];
		$user_reg_date=$row_users['u_reg_date'];
		$user_email=$row_users['u_mail'];
	
	
?>

<form action="" method="post" id="fm2" enctype="multipart/form-data">
		     
		     <table align="center" width="600px">
		     <tr>
			 <td colspan="6"><h2>Edit User:</h2></td>
			 
			 </tr>
			 
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
				 <td><select name="u_gender" value="<?php echo $user_gender;?>">
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
		   
	<?php }?>
		   
<?php
    if(isset($_POST['update'])){
		
		$u_name = $_POST['u_name'];
		$u_pass = $_POST['u_pass'];
		$u_email = $_POST['u_mail'];
		$u_image = $_FILES['u_image']['name'];
		$image_tmp=$_FILES['u_image']['tmp_name'];
		
		move_uploaded_file($image_tmp,"../user/user_images/$u_image");
		
		$update="update user set u_name='$u_name' ,u_pass ='$u_pass' ,u_mail='$u_email',u_image='$u_image' where id='$edit_id'";
        $run=mysqli_query($con,$update);
		
		if($run){
			
			echo"<script>alert('User Is updated!')</script>";
			
			echo"<script>window.open('index.php?view_users','_self')</script>";
			
		}

		}
		
				   
	?>			     


