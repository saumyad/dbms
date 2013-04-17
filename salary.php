
<?php include("essential.php");
check_login();
dbconnect();
echo"<html>
	<head>
		<link type='text/css' rel='stylesheet' href='db.css'> 
		</head>";
		include "header.php";	 
		echo"<body>
		<p align='right'> Welcome " . $_SESSION['user'] . " !!! <br/><a href= 'raw.php'>Home</a></p>";
		
	if(isset($_GET['msg'])){
		echo "<p style='background-color:yellow;color:black' align=right>" . $_GET['msg'] . "</p>" ;
	}
	$query="select Name from DEPARTMENT;";
	$result=execute($query);

	echo"
