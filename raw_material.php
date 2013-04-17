<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">


<?php include "essential.php";
check_login();
dbconnect();
if(!isset($_SESSION['user']) || ($_SESSION['level']))
{
	header("Location:index.php?msg=You are not loged in!");
die();
}
if(isset($_POST['submit']) || isset($_POST['delete']))
{
//		header("Location:error.php?msg='Give a name'");
//		die();
	foreach ($_POST as $key=>$value){
	echo "st".$key." ".$value."chnge";
		if($key != 'R_No' && $key != 'R_Name_d' && ($value=='' ||  $value==null)){
			echo "doing1 ".$key." ";
			$flag=1; 
		}
	}
	echo $flag;
	if($flag==1){
		header("Location:raw_material.php?msg='Form not fully filled'");
		die();
	}

	if(isset($_POST['delete']))
	{
		if(($_POST['R_Name_d']) == null || $_POST['R_Name_d'] == ''){
			header("Location:raw_material.php?msg='Raw-material name not specified'");
			die();
		}
		
		$query5 = "delete from raw_material where Name = '".$_POST['R_Name_d']."';";
		$r=execute($query5);
                $datesql = date("Y-m-d:i:s");
                $queryu = "insert into updates(descr,mytime) values('Raw_Material ".$_POST['R_Name_d']." DELETED','".$datesql."');";
                execute($queryu);

		header("Location:raw_material.php?msg='Raw-material Deleted'");
		die();
	
	}
	if(isset($_POST['submit'])){
	
	if($_POST['a_u'] == 'add'){
		if($_POST['Name'] == "" || !isset($_POST['Name'])){
		header("Location:raw_material.php?msg='Give a name'");
		die();
		}
		$q = "insert into raw_material (Name) values ('" . $_POST['Name'] . "');" ;
		execute($q);
                $datesql = date("Y-m-d:i:s");
                $queryu = "insert into updates(descr,mytime) values('Raw_material ".$_POST['R_Name']." ADDED','".$datesql."');";
                execute($queryu);

		header("Location:raw_material.php?msg='INSERTED'");
		die();
		}
		if($_POST['a_u'] == 'update' )
		{
			$q = "update raw_material set Name='" .$_POST['Name']."' where r_id ='".$_POST['R_No']."';";
			execute($q);
                	$datesql = date("Y-m-d:i:s");
                	$queryu = "insert into updates(descr,mytime) values('Raw_material ".$_POST['R_Name']." UPDATED','".$datesql."');";
                	execute($queryu);
			
		}
	header("location:raw_material.php?msg='Raw-material added/updated successfully'");
	die();
	}
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
	
	
$query1="select r_id from raw_material";
$x1="R_No";
$list1 = generate_list($query1,$x1);
echo"
<div id='insertform'>
<h2> Add-Update Raw-material Form </h2>
<form name='inputform' id='inputform' method='POST' action='".$PHP_SELF."'>
<input type='radio' name='a_u' value = 'add' checked>Add a new Raw-material<br/>
<input type='radio' name='a_u' value = 'update' >Update Raw-material".$list1."
<br/>	
Name of Raw-material:<input type='text' name='Name' /><br/>
<input type='submit' name='submit' value='Add/Update' id='Insert'/>
</form>
</div>";
$_POST['Name'] = escape($_POST['Name']);
$query3="select Name from raw_material";
$x3="R_Name_d";
$list3=generate_list($query3,$x3);
echo"
<div id = 'deleteform'>
<h2> Delete Raw-material Form </h2>
<form name='deleterawm' method='POST' action'" .$PHP_SELF."'>
Select Raw-Material to be deleted: ".$list3."<br/>
<input type='submit' name='delete' value='Delete' id='Delete'/>
</form>
</div>";







include "footer.php";
echo"	</body>
	</html>";
}
?>

