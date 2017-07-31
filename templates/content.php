 <div id="content">
	   <div>
	   <h2 style="margin-top:50px; color:red"> JOIN THE LARGEST BOLLYWOOD NETWORK!</h2>
	       <img id="img" src="images/tds1.jpg" style="float:left; margin-left:-140px; margin-top:60px;margin-bottom:60px"/>
	       <div id="fm2">
		   <form action="" method="post">
		   <h2>Sign Up Today!</h2>
		   <table>
		     <tr>
			     <td><strong>Name:</strong></td>
				 <td><input type="text" name="u_name" placeholder="Enter Your Name" required></td>
		     </tr>
             <tr>
			     <td><strong>Password:</strong></td>
				 <td><input type="password" name="u_pass" placeholder="Enter Your Password" required></td>
		     </tr>
			 <tr>
			     <td><strong>Email:</strong></td>
				 <td><input type="email" name="u_mail" placeholder="Enter Your Email" required></td>
		     </tr>
			 <tr>
			     <td><strong>Country:</strong></td>
				 <td><input type="text" name="u_country" placeholder="Enter Your Country" required></td>
		     </tr>
			 <tr>
			     <td><strong>Gender:</strong></td>
				 <td><select name="u_gender">
				         <option>Male</option>
						 <option>Female</option>
						 <option>Others</option>
						 </select>
						 </td>
		     </tr>
			 
			 <tr>
			     <td><strong>Birthday:</strong></td>
				 <td><input type="date" name="u_birthday" placeholder="Enter Your DOB" required></td>
		     </tr>
			 <tr>
			 <td colspan="6"><button name="sign_up" >Sign Up</button></td>
			 </tr>
			 
		   </table>
		   </form>
		   <?php
		   include("insert.php");
		   ?>
		   </div>
		   </div>
	     