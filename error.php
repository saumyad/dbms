<?php
echo "<html>
<head>

<link type='text/css' rel='stylesheet' href='db.css'/>
</head>
<body>
<p class='welcome'>";
if(isset($_GET['msg'])) echo $_GET['msg'];
else echo 'Oops! Something Bad Happened. Go Back !!';
echo "</p>
</body>
</html>
";
?>
