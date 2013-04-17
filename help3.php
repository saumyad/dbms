<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<?php
echo"<html>
        <head>
        <script type='text/javascript' src='calendarDateInput.js'> </script>
                <script type='text/javascript' src='jquery.js'> </script>
                <link type='text/css' rel='stylesheet' href='db.css'> 
                </head>";
                include "header.php";
                echo"<body><p align='right'>Welcome ". $_SESSION['user'] . " !!!<br/>";  echo date("H:m:s d/m/Y");
               echo" <a href='raw.php' target='_parent'style='color:yellow'>Home</a></p>";


echo"
<div id = 'insertform'>
<b>Employee interface:</b><br/>

After an employee logs in,he has access the following functionality:<br/>
1)EMPLOYEE INFORMATION : User can select all or a set of employees and their entire information is retrieved.<br/>

2)DEPARTMENT INFORMATION: User selects a department to retrieve the department and its manager's information.>br/>

3)RAW MATERIAL INFORMATION: User selects a raw material to find out the tiles using that raw material.<br/>

4)TILE INFORMATION: User selects a tile to find out its details and the raw materials it uses.<br/>

which is common to five tables:<br/>
1) Employee &nbsp;
2) Tiles &nbsp;
3) Raw Material &nbsp;
4) Composition &nbsp;
5) Department<br/>
then he simply logs out.<br/>
<a href= 'help2.php'>Prev</a><br/>

</div>";
?>
