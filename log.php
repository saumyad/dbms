<?php
include("essential.php");
$user = $_POST['username'];
$pwd = $_POST['password'];

dbconnect();

$user = escape($user);
$pwd = escape($pwd);
$q = sprintf("select * from user where name='%s' AND passwrd='%s'",$user,$pwd);
$rv = mysql_query($q,$con);
if(!$rv){
	die("There is some internal error ! Retry");
}
else {
	$num_rows = mysql_num_rows($rv);

	if($num_rows == 1){
		$row = mysql_fetch_assoc($rv);
		session_start();
		$_SESSION['user'] = $row['name'];
		$_SESSION['level'] = $row['level'];
		header("Location:raw.php");
	}
	else{
		header("Location:error.php?msg='Cannot Login'");
	}
	mysql_close( $con );
}
?>
