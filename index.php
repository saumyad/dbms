<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">


<?php
include("essential.php");
if(isset($_SESSION['user'])) header('Location:raw.php');

?>
<html>
<link rel="stylesheet" style = "text/css" href = "db.css">
	<head>
	<body >
	<?php include "header.php";?>
	</br>
		<div id="register_form">
		<p align="right">Login as admin/user to use the sytem</p>
		<form action="log.php" method="POST">
			 <strong>Username : </strong> <input type="text" value="" name="username" id="username" /><br/><br/> 
				<strong>Password :</strong><input type="password" value="" name="password" id="password" /><br/></br>
				 <input type="submit" value="Login" />  
				
		          
			  <br/>
			
		</form>
		</div>
	<?php include "footer.php";?>
	</body>
</html>

