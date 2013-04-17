<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">


<?php include "essential.php";
check_login();
dbconnect();
if(!isset($_SESSION['user']) || ($_SESSION['level']))
{
	header("Location:error.php?msg=Something Bad Happened!");
}
if(isset($_POST['submit']) || isset($_POST['delete']))
{
	foreach ($_POST as $key=>$value){
	echo $key." ".$value."chnge";
		if( $key != 'U_Name_d' && ($value=='' ||  $value==null)){
			echo "doing1 ".$value." ";
			$flag=1;
		}
	}
	if($flag==1){
		header("Location:user.php?msg='Form not fully filled'");
		die();
	}

	if(isset($_POST['delete']))
	{
		if(($_POST['U_Name_d']) == null || $_POST['U_Name_d'] == ''){
			header("Location:user.php?msg='User name not specified'");
			die();
		}
		
		$query5 = "delete from user where name = '".$_POST['U_Name_d']."';";
		$r=execute($query5);
		 $datesql = date("Y-m-d:i:s");
                $queryu = "insert into updates(descr,mytime) values('User ".$_POST['U_Name_d']." DELETED','".$datesql."');";
                execute($queryu);

		header("Location:user.php?msg='User Deleted'");
		die();
	
	}
	
	else{
		$q = "insert into user (name,passwrd,level) values ('" . $_POST['name'] . "','".$_POST['passwrd']."','".$_POST['level'] ."');";
		execute($q);
		 $datesql = date("Y-m-d:i:s");
                $queryu = "insert into updates(descr,mytime) values('Department ".$_POST['U_Name']." INSERTED','".$datesql."');";
                execute($queryu);

		}
	header("location:user.php?msg=User added successfully");
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
		 echo"<body><p align='right'>Welcome ". $_SESSION['user'] . " !!!<br/><a href='raw.php' target='_parent'style='color:yellow'>Home</a></p>";
	
	if(isset($_GET['msg'])){
		echo "<p style='background-color:yellow;color:black' align=right>" . $_GET['msg'] . "</p>" ;
	}
	
	
$query1="select name from user";
$x1="U_Name_d";
$list1 = generate_list($query1,$x1);
echo"
<div id='insertform'>
<h2> Add User Form </h2>
<form name='inputform' id='inputform' method='POST' action='".$PHP_SELF."'>
Add a new user<br/>
Add: &nbsp;&nbsp;<input type='radio' name='level' value='1' checked>Normal user&nbsp;&nbsp;<input type='radio' name='level' value='0'/>Admin<br />
User Name:<input type='text' name='name'/><br/>
Enter password for user:<input type='password' name='passwrd'/><br/>
<input type='submit' name='submit' value='Add/Update' id='Insert'/>
</form>
</div>";
$_POST['name'] = escape($_POST['name']);
echo"
<div id = 'deleteform'>
<h2> Delete User Form </h2>
<form name='deleteusr' method='POST' action'" .$PHP_SELF."'>
Select User to be deleted: ".$list1."<br/>
<input type='submit' name='delete' value='Delete' id='Delete'/>
</form>
</div>";







include "footer.php";
echo"	</body>
	</html>";
}
?>

