
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
	if(isset($_POST['delete'])){
		if($_POST['dtid'] == '' || $_POST['dRawname'] == ''){
		header("Location:comp.php?msg='Form not fully filled'");
		die();
		}
		$essq1 = "select r_id from raw_material where Name = '".$_POST['dRawname']."';";
		$essq = execute($essq1);
		$essq=mysql_fetch_assoc($essq);
		$check1 = "delete from composition where t_id = '".$_POST['dtid']."' AND rawmtrl_id = '".$essq['r_id']."';";
		$result1=execute($check1);
		$affect = mysql_affected_rows();
//		echo $affect;
		if($affect == 0)
			header("location:comp.php?msg=The given entry was not found in the database");
		else{
		$datesql = date("Y-m-d H:i:s");
		$queryu = "insert into updates(descr,mytime) values('Raw material ".$_POST['dRawname']." DELETED from ".$_POST['dtid']."','".$datesql."');";
		execute($queryu);
			header("location:comp.php?msg=The given entry is deleted");
		die();
	}
	}
	if(isset($_POST['submit'])){
		if($_POST['tid'] == '' || $_POST['Rawname'] == ''){
			header("Location:comp.php?msg='Form not fully filled'");
			die();
			
		}
		$essq1 = "select r_id from raw_material where Name = '".$_POST['Rawname']."';";
		$essq = execute($essq1);
		$essq=mysql_fetch_assoc($essq);
		$check2 = "select * from composition where t_id = '".$_POST['tid']."' and rawmtrl_id = '".$essq['r_id']."';";
		$result2=execute($check2);
		if(mysql_num_rows($result2) == 0){

			$check3 = "insert into composition values( '".$_POST['tid']."' , '".$essq['r_id']."');";
			execute($check3);
		$datesql = date("Y-m-d H:i:s");
		$queryu = "insert into updates(descr,mytime) values('Raw material ".$_POST['Rawname']." INSERTED TO ".$_POST['tid']."','".$datesql."');";
		execute($queryu);
			header("location:comp.php?msg=The given entry was inserted");
			die();
		}
		else{
			header("location:comp.php?msg=The given entry was already present");
			die();
		}
	}
}
else{
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
	
	
$query1="select Tile_ID from tiles;";
$x1="tid";
$list1 = generate_list($query1,$x1);
$query2="select Name from raw_material; ";
$x2="Rawname";
$list2=generate_list($query2,$x2);
echo"
<div id='insertform'>
<h2> Add Composition Form </h2><br/>
<form name='inputform' id='inputform' method='POST' action='".$PHP_SELF."'>
Tile ID: ".$list1."
<br/><br/>		
Select Raw materials to be added: ".$list2."<br/><br/>       
      <input type='submit' name='submit' value='Add' id='Insert'/>
</form>
</div>";

$x3="dtid";
$x4="dRawname";
$list3=generate_list($query1,$x3);
$list4=generate_list($query2,$x4);
echo"
<div id = 'deleteform'>
<h2> Delete Composition Form </h2><br/>
<form name='deleteemp' method='POST' action'" .$PHP_SELF."'>
Tile ID : ".$list3."<br/><br/>
Raw material to be deleted: ".$list4."<br/><br/>
<input type='submit' name='delete' value='Delete' id='Delete'/>
</form>
</div>";







include "footer.php";
echo"	</body>
	</html>";
}
?>
