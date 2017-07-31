

<?php

session_start();

include("../includes/connection.php");

if(!isset($_SESSION['admin_email'])){
	header("location:admin_login.php");
	
}

else {
?>

<!DOCTYPE html>

<html>
    
	  <head>
	  
	  <link rel="stylesheet" href="admin_style.css" media="all">
	        <title>Welcome To Admin Panel</title>
	  </head>
	  
	  <body>
	  
	  <div class="container">
	     <div id="head">
		  
		      <img src="logo.jpg" width="1000px"/>
		  </div>
		  
		  
		  
		  
		  <div id="sidebar">
		  <h2>Manage Content:</h2>
		  
		  <ul id="menu">
		  
		     <li><a href="index.php?view_users">View Users</a></li>
		     <li><a href="index.php?view_posts">View Posts</a></li>
			 <li><a href="index.php?view_comments">View Comments</a></li>
			 <li><a href="index.php?view_topics">View Topics</a></li>
			 <li><a href="index.php?add_topic">Add New Topic</a></li>
			 <li><a href="logout.php">Log Out</a></li>
			 
		  
		  
		  </ul>
		  </div>
		  
		  <div id="content">
		  
		  <h1 style="color:blue; text-align:center; padding:5px;">Welcome Admin:Manage Your Posts</h2>
		  
		  <?php
		      if(isset($_GET['view_users'])){
				  include("includes/view_users.php");
			  }
			  
			  if(isset($_GET['view_posts'])){
				  include("includes/view_posts.php");
			  }
			  ?>
		  </div>
		  
		  <div id="foot">
		     <h2 style="color:white;text-align:center;"> &copy @ 2017 </h2>
		  </div>
		 
     </div>		 
	  
	  </body>
	  </html>
<?php }?>