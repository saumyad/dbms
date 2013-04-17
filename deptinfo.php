
<?php include("essential.php");
check_login();
dbconnect();

if(isset($_POST['submit'])){

		if(empty($_POST['D_Name'])){
			header("location:deptinfo.php?msg='You did not select any department'");
			die();
		}
		$query1 = "select Dept_ID, Mgr_ID, E.Name as ename, Salary, Sex, D_O_B, Job_Type, Eng_Type from DEPARTMENT as D, EMPLOYEES as E where Mgr_ID = Emp_ID and D.Name = '".$_POST['D_Name']."';";
		$result1 = execute($query1);
		$result3 = execute($query1);
		
		$result2=mysql_fetch_assoc($result1);
	
	echo"<html><body>
<head>
<link rel='stylesheet' type='text/css' href='db.css' />
<title>EMPLOYEES</title>
<h1 align='center'>Welcome '".$_SESSION['user']."'</h1><br>
<a href='deptinfo.php' align = 'center'>BACK!</a>
</head>
<BODY>";
				echo"Department ID:  ";
				echo $result2['Dept_ID'];
				echo"<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo"Department Name:  ";
				echo $_POST['D_Name'];
				echo"<TABLE BORDER=2 align='center' >
				<tr><th>Mgr_ID</th>
				<th>Name</th>
				<th>Salary</th>
				<th>Sex</th>
				<th>Date of birth</th>
				<th>Job Type</th>
				<th>Eng Type</th>
				</tr>";
				
				while($row=mysql_fetch_assoc($result3)){
				
				echo"<p align='center'>Manager's Information</p>";
				echo "<tr><td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $row['Mgr_ID'];
				echo "</font></td>
					<td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $row['ename'];
				echo "</font></td>
					<td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $row['Salary']; 
				echo "</font></td>
					<td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $row['Sex']; 
				echo "</font></td>
					<td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $row['D_O_B']; 
				echo "</font></td>
					<td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $row['Job_Type']; 
				echo "</font></td>
					<td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $row['Eng_Type']; 
				echo"</font></td></tr>";
			} 
			echo "</TABLE>";
		
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
	$query="select Name from DEPARTMENT";
	$x="D_Name";
	$list=generate_list($query,$x);
	echo"<div id='query'>
		<h2 align='center'> DEPARTMENT INFORMATION</h2><br/>
		<form name = 'queryf' action = '".$PHP_SELF."' method = 'POST'> 
		Select a department:".$list."";
	echo"<input type=submit name=submit id=submit value=Results>
			</form>
			</div>
			</body></html>";
	
}
?>

