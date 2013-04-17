<?php
session_start();
$con = 0;
function check_login(){
	if(!isset($_SESSION['user'])){
		header('Location:index.php');
	}

}
function generate_list($q,$x,$isnull = true){
	$r = execute($q);
	$i=0;
	$rowcount = mysql_num_rows($r);
	$st = "<select name='" . $x . "' id='" . $x . "'>";
	if($isnull) $st .= "<option value='' >--Please select--</option>";
	while($row = mysql_fetch_array($r,MYSQL_NUM)){
		$st .= "<option value='".$row[0]."' id='".$row[0]."'>".$row[0]."</option>";
	}
	$st .= "</select>";
	return $st;
}
function generate_timeslot($myid){
	$st = "<select name='". $myid . "' id='". $myid." >";
	$st .= "<option value='' id='fg'>Please select</option>";
	for($i=0;$i<24;$i++){
	  $dig=0;
	  $k = $i;
	  while($k>0){
	    $k/=10;
	    $dig++;
	  }
	  $j = $i.'';
	  if($i<10){
	    $j = '0' . $j;
	  }
	  $j1 = $j.":00:00";
	  $j2 = $j.":30:00";
	  $st .= "<option value='" . $j1 . "' name='" . $j1 . "' id='" .$j1."'>".$j1."</option>";
	  $st .= "<option value='" . $j2 . "' name='" . $j2 . "' id='" .$j2."'>".$j2."</option>";
	  
	}
	$st .= "</select>";
	return $st;
}
function execute($q){
	GLOBAL $con;
	if($con == 0 ){
		dbconnect();
	}
	$r = mysql_query($q,$con);
	if(!$r){
		die("Cannot execute the query".$q);
	}
	else{
		return $r;
	}
}

function dbconnect(){
	GLOBAL $con;
	$con = mysql_connect('localhost','root','sqlpassword');
	if(!$con){
		die("no connection");
	}
	else {
		$q = "use Tiles";
		$rv = mysql_query( $q , $con);
		if(!$rv){
			die("no database!");
		}

	}
}

function escape($x){
	$x = stripslashes($x);
	$x = mysql_real_escape_string($x);
	return ($x);
}
function make_array($a){
	$all = array();
	while($row = mysql_fetch_array($a))
	{
		$all[] = $row[0];
	}

	return $all;
}

function paginate($file,$myquery,$start=0,$lim=10)
{
        $query1 = $myquery.";";
	
        $result=execute($query1);
        $num = mysql_num_rows($result);
        if($num == 0)
        {
                return $result;
        }
        $back = $start - $lim;
        $next = $start + $lim;
        $query2= $myquery." limit ".$start.",".$lim.";";
        $result2=execute($query2);
        echo mysql_error();
	$index=1;
        if($num > $lim){                // display links only if records are enuf.
                if($back >=0){
                        echo"<a href='".$file."?st=".$back."'>PREV</a>";
                }
                for($i=0;$i<$num;$i=$i+$lim){
                        if($i != $start){

                        echo" <a href='".$file."?st=".$i."'>";
                        echo ' '.$index;
                        echo "</a>";
                        }
                        else{
                                echo ' ';
                                echo $index;
                        }
			$index = $index+1;
                }
                if($next < $num){
                        echo" <a href='".$file."?st=".$next."'> NEXT</a>";
		}
	}
	return $result2;
	
                                                                          
}


