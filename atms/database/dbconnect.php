<?php
$host="localhost";
$user="admink6KFNC4";
$password="kNzYs7hsuiUP";
$db="atdb";
$connect= mysql_connect($host, $user, $password) or die ("Problem in Connection:" . mysql_error() );
$dbselect= mysql_select_db($db, $connect) or die ("Problem in DB Selection:" . mysql_error() );
	
?>