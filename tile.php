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
//	if($_POST['Eng_Type'] == "")
//		$_POST['Eng_Type'] = 'EMPTY';
	foreach ($_POST as $key=>$value){
	echo $key." ".$value."chnge";
		if($key != 'T_No' && $key != 'T_Name_d' && ($value=='' ||  $value==null)){
			echo "doing1 ".$value." ";
			$flag=1;
		}
	}
	if($flag==1){
		header("Location:tile.php?msg='Form not fully filled'");
		die();
	}


	if(isset($_POST['delete']))
	{
		if(($_POST['T_Name_d']) == null || $_POST['T_Name_d'] == ''){
			header("Location:tile.php?msg='Tile name not specified'");
			die();
		}
		
		$query5 = "delete from tiles where tile_name = '".$_POST['T_Name_d']."';";
		$r=execute($query5);
                $datesql = date("Y-m-d:i:s");
                $queryu = "insert into updates(descr,mytime) values('Tile ".$_POST['T_Name_d']." DELETED','".$datesql."');";
                execute($queryu);

		header("Location:tile.php?msg='Tile Deleted'");
		die();
	
	}
	
	if($_POST['a_u'] == 'add'){
		$q = "insert into tiles (tile_name,Size_len,Size_bre,Material_type,Glazed,Polished,Quantity_produced,name_use) values ('" . $_POST['tile_name'] . "','" . $_POST['Size_len'] . "','".$_POST['Size_bre']."','".$_POST['Material_type']."','".$_POST['Glazed']."','".$_POST['Polished']."','".$_POST['Quantity_produced']."','".$_POST['name_use']."');" ;
		execute($q);
		 $datesql = date("Y-m-d:i:s");
                $queryu = "insert into updates(descr,mytime) values('Tile ".$_POST['T_Name']." ADDED','".$datesql."');";
                execute($queryu);

		}
		if($_POST['a_u'] == 'update' )
		{
			$q = "update tiles set tile_name='" .$_POST['tile_name']. "', Size_len='" . $_POST['Size_len'] . "', Size_bre ='".$_POST['Size_bre']."', Material_type='".$_POST['Material_type']."', Glazed='".$_POST['Glazed']."' , Polished='" .$_POST['Polished']."' where Tile_ID ='".$_POST['T_No']."';";
			execute($q);
			 $datesql = date("Y-m-d:i:s");
                $queryu = "insert into updates(descr,mytime) values('Tile ".$_POST['T_Name']." UPDATED','".$datesql."');";
                execute($queryu);

		}
	header("location:tile.php?msg=Tile added/updated successfully");
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
	
	
$query1="select Tile_ID from tiles";
$x1="T_No";
$list1 = generate_list($query1,$x1);
echo"
<div id='insertform'>
<h2> Add-Update Tiles Form </h2>
<form name='inputform' id='inputform' method='POST' action='".$PHP_SELF."'>
<input type='radio' name='a_u' value = 'add' checked>Add a new Tile<br/>
<input type='radio' name='a_u' value = 'update' >Update Tile Info".$list1."
<br/>		
Name of tile:<input type='text' name='tile_name' /><br/>
SIZE:
&nbsp;&nbsp;Length:<input type='number' name='Size_len' min='150' size = 11 value = 500>
&nbsp;&nbsp;Breadth:<input type='number' name='Size_bre' min='150' size = 11 value = 500 ><br/>
Material Type:    &nbsp;&nbsp;<input type='radio' name='Material_type' value='1'checked/>Ceramic
&nbsp;&nbsp;<input type='radio' name='Material_type' value='0'/>Vetrified<br />
<input type='radio' name='Glazed' value='1'checked/>Glazed
<input type='radio' name='Glazed' value='0'/>Unglazed<br/>
<input type='radio' name='Polished' value='1'checked/>Polished
<input type='radio' name='Polished' value='0'/>Unpolished<br/>
<input type='radio' name='name_use' value='1'checked/>Floor Tile
<input type='radio' name='name_use' value='0'/>Wall Tile <br/>
Quantity Produced:<input type='number' name='Quantity_produced' min='50' size = 11 value = 250 ><br/>
<input type='submit' name='submit' value='Add/Update' id='Insert'/>
</form>
</div>";
$_POST['tile_name'] = escape($_POST['tile_name']);
	
	
$query3="select tile_name from tiles";
$x3="T_Name_d";
$list3=generate_list($query3,$x3);
echo"
<div id = 'deleteform'>
<h2> Delete Tile Form </h2>
<form name='deletetile' method='POST' action'" .$PHP_SELF."'>
Select Tile to be deleted: ".$list3."<br/>
<input type='submit' name='delete' value='Delete' id='Delete'/>
</form>
</div>";







include "footer.php";
echo"	</body>
	</html>";
}
?>

