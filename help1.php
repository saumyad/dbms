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
The database application of<u> Kajaria tiles </u>opens with a login page, in which a user can login as a database admin or an employee.<br/>

        The database admin has complete access over the records of all the tables in the database and full permissions to insert or modify/delete the data records apart from viewing the data.<br/>
        In the login page, the admin can login with a predefined user name ( in our case, its admin ) and a password, which is then send to a middle tier function, which matches it with the already stored name and password in the database.<br/>
        
        The user(employee) on the other hand, can not modify the data in any case and can only view the records. He also logs in with the user name and password, which is also stored in the database table. <br/> <a href='help2.php' target='_parent'> Next </a><br/>
 </div>";
?>
