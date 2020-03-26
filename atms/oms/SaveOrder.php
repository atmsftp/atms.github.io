<?PHP
session_start();
include('../includes/header.php'); 
require ('../database/dbconnect.php');

if(isset($_SESSION["NEWORDER"]))
{
	
	$Title=$_POST["Title"];
	$name=$_POST["name"];
	$Mobile=$_POST["MobileNumber"];
	$order=$_POST["OrderDetails"];
	$type=$_POST["OrderType"];
	$priority=$_POST["Priority"];
	$comment=$_POST["Comment"];
	
	
	$sql = "INSERT INTO $db.`order` (`ORN`, `TITLE`, `NAME`, `MOBILE_NUMBER`, `ORDER`, `TYPE`, `PRIORITY`, `COMMENT`) 
		VALUES
		(NULL,'$Title','$name','$Mobile','$order','$type','$priority','$comment')";
	$query=mysql_query($sql) or die("Query Incorrect." . mysql_error());
	$latestID= mysql_insert_id();
	$sql1 = "INSERT INTO $db.`order_status` (`ORN`, `STATUS`, `EXPLAIN`) 
			VALUES
		('$latestID','Pending','')";
	$query1=mysql_query($sql1) or die("Unable to feed at Status Table." . mysql_error());
	if($query && $query1)
	{
	?>
		<script type="text/javascript">alert("Thank You! Your ORN is:<?PHP echo $latestID?>");</script>
	<?PHP
	}
$query=0;
	$sql="select * from `order` where ORN=$latestID";
	$query=mysql_query($sql) or die("Unable to fetch data to print slip. <br>" . mysql_error());
	if($query)
	{
	$data= mysql_fetch_array($query);
	?>
	<html>
	<body width="700px" height="700px">
	<form><center>
	<div align="center" id="receipt">	
	<table id="table1">
	<tr>
		<td><center><img src="../Images/Amt2.png" alt="Amit Traders"></center></td>
		<td><center><h1>Amit Traders Order Receipt</h1></center></td>
	</tr>
	</table>
	<table id="table1">
	<tr>
		<td id="tdHeading"><b>ORN</b></td><td id="tdData"><?PHP echo $data['ORN'];?></td>
		<td id="tdHeading"><b>Date Stamp</b></td><td id="tdData"><?php echo $data['TIMESTAMP'];?></td>
	</tr>
	<tr>
		<td id="tdHeading"><b>Category</b></td><td id="tdData"><?PHP echo $data['TITLE'];?></td>
		<td id="tdHeading"><b>Name</b></td><td id="tdData"><?PHP echo $data['NAME'];?></td>
	</tr>
	<tr>
		<td id="tdHeading"><b>Mobile Number</b></td><td id="tdData"><?PHP echo $data['MOBILE_NUMBER'];?></td>
		<td id="tdHeading"><b>Order Type</b></td><td id="tdData"><?php echo $data['TYPE'];?></td>
	</tr>
	<tr>
		<td id="tdHeading"><b>Order</b></td><td id="tdData"><?PHP echo $data['ORDER'];?></td>
		<td id="tdHeading"><b>Signature</b></td><td id="tdData"></td>
	</tr>
	</table>
	</div>
	</form>
	<input type="button"value="PRINT" onclick="window.print()">
	<a href="OMS_Menu.php"><button>BACK</button></a>
	</center></body></html>
	<?PHP
	unset($_SESSION['NEWORDER']);
	session_destroy();
	}
	else
	{
	echo "Sorry Print Slip cant not be formed!!.";
	unset($_SESSION["NEWORDER"]);
	session_destroy();
	}
}
else
{
	echo "False or Wrong Entry. Session Violated";
	?><a href="OMS_Menu.php"> GO BACK</a><?PHP
}
?>

