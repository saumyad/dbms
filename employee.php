<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">


<?php include "essential.php";
check_login();
dbconnect();
if(!isset($_SESSION['user']) || ($_SESSION['level']))
{
	header("Location:index.php?msg=You are not logged in");
}
if(isset($_POST['submit']) || isset($_POST['delete']))
{
	if($_POST['Eng_Type'] == "")
		$_POST['Eng_Type'] = 'EMPTY';
	foreach ($_POST as $key=>$value){
	echo $key." ".$value."chnge";
		if($key != 'E_No' && $key != 'E_No_d' && ($value=='' ||  $value==null)){
			echo "doing1 ".$value." ";
			$flag=1;
		}
	}
	if($flag==1){
		header("Location:employee.php?msg='Form not fully filled'");
		die();
	}


	if(isset($_POST['delete']))
	{
		if(($_POST['E_No_d']) == null || $_POST['E_No_d'] == ''){
			header("Location:employee.php?msg='Employee id not specified'");
			die();
		}
		$query10 = "select Name from EMPLOYEES where Emp_Id = '".$_POST['E_No_d']."';";
		$empdname=execute($query10);
		$empdname=mysql_fetch_assoc($empdname);
		
		$query5 = "delete from EMPLOYEES where Emp_Id = '".$_POST['E_No_d']."';";
		$r=execute($query5);
		$datesql = date("Y-m-d H:i:s");
		$queryu = "insert into updates(descr,mytime) values('Employee ".$empdname['Name']." DELETED','".$datesql."');";
		execute($queryu);
		header("Location:employee.php?msg='Employee Deleted'");
		die();
	
	}
	
		$_POST['Name'] = escape($_POST['Name']);
		$_POST['Job_Type'] = escape($_POST['Job_Type']);
		$_POST['Eng_Type'] = escape($_POST['Eng_Type']);
		if(!(is_numeric($_POST['Salary'])))
		{
			header("Location:employee.php?msg=Give a valid salary");
		}
	if($_POST['a_u'] == 'add'){
		$q = "insert into EMPLOYEES (Name,Salary,Sex,D_O_B,Job_Type,Eng_Type,D_No) values ('" . $_POST['Name'] . "','" . $_POST['Salary'] . "','".$_POST['Sex']."','".$_POST['d_o_b']."','".$_POST['Job_Type']."','".$_POST['Eng_Type']."','".$_POST['D_No']."');" ;
		execute($q);
		$datesql = date("Y-m-d H:i:s");
		$queryu = "insert into updates(descr,mytime) values('Employee ".$_POST['Name']." inserted','".$datesql."');";
		execute($queryu);
		}
		if($_POST['a_u'] == 'update')
		{
			$q = "update EMPLOYEES set Name='" .$_POST['Name']. "', Salary='" . $_POST['Salary'] . "', Sex ='".$_POST['Sex']."', D_O_B='".$_POST['d_o_b']."', Job_Type='".$_POST['Job_Type']."' , Eng_Type='" .$_POST['Eng_Type']."' where Emp_Id ='".$_POST['E_No']."';";
			execute($q);
		$datesql = date("Y-m-d H:i:s");
		$queryu = "insert into updates(descr,mytime) values('Employee ".$empdname." updated','".$datesql."');";
		execute($queryu);
		}
	header("location:employee.php?msg=Employee added/updated successfully");
	die();

}
else{
echo"<html>
	<head>
 	<script type='text/javascript' src='calendarDateInput.js'> </script>
		<script type='text/javascript' src='jquery.js'> </script>
		<link type='text/css' rel='stylesheet' href='db.css'> 
		</head>";
		include "header.php";	 
		echo"<body><p align='right' > Welcome ". $_SESSION['user'] ." !!! <br/>"; echo date("H:m:s d/m/Y"); echo "<a href= 'raw.php' target='_parent' style='color:yellow'>  Home</a></p>";
		
	if(isset($_GET['msg'])){
		echo "<p style='background-color:yellow;color:black' align=right>" . $_GET['msg'] . "</p>" ;
	}
	
	
$query1="select Dept_ID from DEPARTMENT";
$x1="D_No";
$list1 = generate_list($query1,$x1);
$query2="select Emp_Id from EMPLOYEES";
$x2="E_No";
$list2=generate_list($query2,$x2);
echo"
<div id='insertform'>
<h2> Add-Update Employee Form </h2>
<form name='inputform' id='inputform' method='POST' action='".$PHP_SELF."'>
<input type='radio' name='a_u' value = 'add' checked>Add a new Employee<br/>
<input type='radio' name='a_u' value = 'update' >Update Employee Info".$list2."
<br/>		
Name:<input type='text' name='Name'/><br/>
Salary:<input type='text' name='Salary'/><br/>
Sex:<input type='radio' name='Sex' value='M'checked/>Male 
    <input type='radio' name='Sex' value='F'/>Female<br/>
Date of birth:<script>DateInput('d_o_b', true, 'YYYY-MM-DD')</script> 
Job type:<input type='text' name='Job_Type'/><br/>
Engineering Type:<input type='text' name='Eng_Type' value='EMPTY'/><br/>
Department number:".$list1."
<input type='submit' name='submit' value='Add/Update' id='Insert'/>
</form>
</div>";

$query3="select Emp_Id from EMPLOYEES";
$x3="E_No_d";
$list3=generate_list($query2,$x3);
echo"
<div id = 'deleteform'>
<h2> Delete Employee Form </h2>
<form name='deleteemp' method='POST' action'" .$PHP_SELF."'>
Select Employee to be deleted: ".$list3."<br/>
<input type='submit' name='delete' value='Delete' id='Delete'/>
</form>
</div>";







include "footer.php";
echo"	</body>
	</html>";
}
?>

