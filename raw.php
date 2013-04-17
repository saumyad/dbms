<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">


<?php include_once ("essential.php") ;


if(!isset($_SESSION['user']))
{
	header("Location:index.php?msg=You are logged out");
}
?>

<html>
	<link rel='stylesheet' type='text/css' href='db.css'>
	<title>Welcome To Kajaria Tiles Home Page</title>
	<body>
	<?php include "header.php" ;?>
	<div id='rest'>
	<h2>Welcome <?php echo $_SESSION['user'];?></h2>
	<br/><br/><?php echo date("H:m:s d/m/Y"); ?>
	</div>
	
	<?php include "menu.php";?>
	<?php include "sidebar.php" ;?>
	<?php include "footer.php" ;?>
	</body>
	</html>
	
	
