<?PHP
session_start();
include('../includes/header.php'); 
require ('../database/dbconnect.php');

if(isset($_SESSION["NEWORDER"]))
{
	
	$order=$_POST["OrderDetails"];
	$type=$_POST["OrderType"];
	$priority=$_POST["Priority"];
	$comment=$_POST["Comment"];
		
	$sql = "INSERT INTO $db.`shoporder` (`SORN`, `ORDER`, `TYPE`, `PRIORITY`, `COMMENT`) 
		VALUES
		(NULL,'$order','$type','$priority','$comment')";
	$query=mysql_query($sql) or die("Query Incorrect." . mysql_error());
	$latestID= mysql_insert_id();
	$sql1 = "INSERT INTO $db.`shoporder_status` (`SORN`, `STATUS`, `DETAILS`) 
			VALUES
		('$latestID','Pending','')";
	$query1=mysql_query($sql1) or die("Unable to feed at Status Table." . mysql_error());
	if($query && $query1)
	{
	?>
		<script type="text/javascript">alert("Thank You! Your SORN is:<?PHP echo $latestID?>");</script>
	<?PHP
	}

	unset($_SESSION["NEWORDER"]);
	session_destroy();
	?>
	<script type="text/javascript">
		document.location="New_Order.php";
	</script>
	<?PHP
}
else
{
	echo "False or Wrong Entry. Session Violated";
	?><a href="OMS_Menu.php"> GO BACK</a><?PHP
}
?>