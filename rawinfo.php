
<?php include("essential.php");
check_login();
dbconnect();

if(isset($_POST['submit'])){

		if(empty($_POST['R_Name'])){
			header("location:rawinfo.php?msg='You did not select any raw-material'");
			die();
		}
		$query1= "select tile_name from raw_material, tiles, composition where Tile_ID = t_id and rawmtrl_id = r_id and Name = '".$_POST['R_Name']."';";
		$result1 = execute($query1);
	
	echo"<html><body>
<head>
<link rel='stylesheet' type='text/css' href='db.css' />
<title>EMPLOYEES</title>
<h1 align='center'>Welcome '".$_SESSION['user']."'</h1><br>
<a href='rawinfo.php' align = 'center'>BACK!</a>
</head>
<BODY>";
		echo" Raw-material name: ";
		echo $_POST['R_Name'];
		echo"<br/> Tiles made using this raw-material:<br/> ";			
		while($row=mysql_fetch_assoc($result1)){
		echo $row['tile_name']."<br/>";
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
	$query="select Name from raw_material";
	$x="R_Name";
	$list=generate_list($query,$x);
	echo"<div id='query'>
		<h2 align='center'> RAW-MATERIAL INFORMATION</h2><br/>
		<form name = 'queryf' action = '".$PHP_SELF."' method = 'POST'> 
		Select name of raw-material:".$list."";
	echo"<input type=submit name=submit id=submit value=Results>
			</form>
			</div>
			</body></html>";
	
}
?>

