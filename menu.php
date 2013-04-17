<?php
if(!isset($_SESSION['user']) || !isset($_SESSION['level']))
{
	header("location:error.php?msg=USER NOT DEFINED");
}
else{
	echo"<div id = 'menu'>";


	if ($_SESSION['level'] != 1){
		echo"
			<a href='employee.php' target='_parent'> Employees </a><br/>
			<a href='department.php' target='_parent'> Department </a><br/>
			<a href='tile.php' target='_parent'>Tile Information </a><br/>
			<a href='raw_material.php' target='_parent'>Raw Material </a><br />
			<a href='comp.php' target='_parent'>Composition </a><br />
			<a href='user.php' target='_parent'>User</a><br />
			<a href='logout.php' target='_top'> LOGOUT </a><br/>
			<a href='help1.php' target='_parent'> Help! </a><br/>
			";

	}
	else
	{
		echo"
			<a href='logout.php' target='_top'> LOGOUT </a><br/>
			";

	}
	echo"

		</div>
		";
}
?>
