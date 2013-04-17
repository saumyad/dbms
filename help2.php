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
<b>Admin interface :</b>
 Once the admin logs in, he has access to three functionalities:<br/>
* Insert  * Delete  * Update<br/>

which are all common to five tables:<br/>
1) Employee 2) Tiles 3) Raw Material 4) Composition 5) Department<br/>

Also he can access functionalities generally defined for the database. :<br/>
1)EMPLOYEE INFORMATION : User can select all or a set of employees and their entire information is retrieved.<br/>

2)DEPARTMENT INFORMATION: User selects a department to retrieve the department and its manager's information.<br/>

3)RAW MATERIAL INFORMATION: User selects a raw material to find out the tiles using that raw material.<br/>

4)TILE INFORMATION: User selects a tile to find out its details and the raw materials it uses.<br/>
There would be five pages in total, consisting of insert,delete and update forms corresponding to each table.<br/>
<a href = 'help1.php'>Prev</a>|<a href = 'help3.php'>Next</a>

</div>";
?>
