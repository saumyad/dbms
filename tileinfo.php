
<?php include("essential.php");
check_login();
dbconnect();

if(isset($_POST['submit'])){

		if(empty($_POST['T_Name'])){
			header("location:tileinfo.php?msg='You did not select any tile'");
			die();
		}
		$query1= "select Name from raw_material, tiles, composition where Tile_ID = t_id and rawmtrl_id = r_id and tile_name = '".$_POST['T_Name']."';";
		$result1 = execute($query1);
	
	echo"<html><body>
<head>
<link rel='stylesheet' type='text/css' href='db.css' />
<title>EMPLOYEES</title>
<h1 align='center'>Welcome '".$_SESSION['user']."'</h1><br>
<a href='tileinfo.php' align = 'center'>BACK!</a>
</head>
<BODY>";
		echo" Tile name: ";
		echo $_POST['T_Name'];
		echo"<br/> Raw materials used to make the Tile:<br/> ";			
		while($row=mysql_fetch_assoc($result1)){
		echo $row['Name']."<br/>";
		}	
		echo "</BODY>
			</HTML>";

}
else{

echo"<html>
	<head>
 	<script type='text/javascript' src='calendarDateInput.js'> </script>
		<script type='text/javascript' src='jquery.js'> </script>
		<link type='text/css' rel='stylesheet' href='db.css'> 
		</head>";
		include "header.php";	 
		echo"<body>
		<p align='right'> Welcome " . $_SESSION['user'] . " !!! <br/><a href= 'raw.php'>Home</a></p>";
		
	if(isset($_GET['msg'])){
		echo "<p style='background-color:yellow;color:black' align=right>" . $_GET['msg'] . "</p>" ;
	}
	$query="select tile_name from tiles";
	$x="T_Name";
	$list=generate_list($query,$x);
	echo"<div id='query'>
		<h2 align='center'> TILE INFORMATION</h2><br/>
		<form name = 'queryf' action = '".$PHP_SELF."' method = 'POST'> 
		Select Tile name:".$list."";
	echo"<input type=submit name=submit id=submit value=Results>
			</form>
			</div>
			</body></html>";
	
}
?>

