
<?php include("essential.php");
check_login();
dbconnect();

if(isset($_POST['submit'])){

	if($_POST['sel'] == 'all'){
		$query1 = "select * from EMPLOYEES;";
		$result1 = execute($query1);
	}
	if($_POST['sel'] == 'some'){
		$emparray = array();
		if(empty($_POST['Employee'])){
			header("location:empinfo.php?You did not select any employee");
			die();
		}
		else{
			$count = count($_POST['Employee']);
			for($i=0;$i<$count;$i=$i+1){
			$emparray[] = $_POST['Employee'][$i];
			}
			$emparray = implode(", ",$emparray);
			$query1 = "select * from EMPLOYEES where Emp_Id IN (".$emparray.");";
			$result1 = execute($query1);
		}
	}
	echo"<html><body>
<head>
<link rel='stylesheet' type='text/css' href='db.css' />
<title>EMPLOYEES</title>
<h1 align='center'>Welcome '".$_SESSION['user']."'</h1><br>
<a href='empinfo.php' align = 'center'>BACK!</a>
</head>
<BODY>
				<TABLE BORDER=2 align='center' >
				<tr><th>EmpID</th>
				<th>Name</th>
				<th>Salary</th>

				<th>Sex</th>
				<th>Date of birth</th>
				<th>Job Type</th>
				<th>Eng Type</th>
				<th>Department</th>
				</tr>";
				while($row=mysql_fetch_assoc($result1)){
				echo "<tr><td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $row['Emp_ID'];
				echo "</font></td>
					<td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $row['Name'];
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
				echo "</font></td>
					<td><font face = 'Arial, Helvetica, sans-serif'>";
				echo $row['D_No']; 
				echo "</font></td>
					</tr>";
			} 
			echo "</TABLE>";
		
		echo "</BODY>
			</HTML>";

}
else{

if(isset($_GET['st']))
        $mstart=$_GET['st'];
else
        $mstart=0;
$lim=2;   

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
	$query="select Emp_Id, Name from EMPLOYEES";

	echo"<div id='query'>
		<h2 align='center'> EMPLOYEE INFORMATION</h2><br/>
		<form name = 'queryf' action = '".$PHP_SELF."' method = 'POST'> 
		Select the employees<br/>
		<input type=radio name=sel id = sel1 value=all checked>All<br/>
		<input type=radio name=sel id = sel2 value=some>Choose employees                 ";
		
	$category=paginate('empinfo.php',$query,$mstart,$lim);
		echo"<br/><br/>";
		    if(!mysql_num_rows($category))
		    {
			    echo "No Available Employees";
		    }
		    else{
			    while($row = mysql_fetch_array($category)){
		    		echo"          <input type='checkbox' name='Employee[]' value='".$row['Emp_Id']."'>".$row['Emp_Id']."   ".$row['Name']."<br/>";
		    }
		}
		echo"<input type=submit name=submit id=submit value=Results>
			</form>
			</div>
			</body></html>";
	
}
?>

