
<?php include("essential.php");
check_login();
dbconnect();

if(isset($_GET['st']))
	
        $mstart=$_GET['st'];
else{
        $mstart=0;
}
$lim=3;   

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
	$query ="select * from updates order by mytime desc";
		echo"		<TABLE BORDER=2 align='center' >
				<tr><th>No.</th>
				<th>Event</th>
				<th>Name</th></tr>";
$q=1;	
$category=paginate('updates.php',$query,$mstart,$lim);

				while($row=mysql_fetch_assoc($category)){
				echo "<tr><td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $q;
				echo "</font></td>
					<td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $row['descr'];
				echo "</font></td>
					<td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $row['mytime'];
				echo "</font></td>
					</tr>";
		$q = $q+1;
			} 
			echo "</TABLE>";
		
		echo "</BODY>
			</HTML>";

?> 
