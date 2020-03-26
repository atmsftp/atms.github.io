<?php
session_start();
include('../includes/header.php');
require('../database/dbconnect.php');
$sessionCheck=$_POST["NewEntry"];
if(!empty($sessionCheck))
{
	$FirstName= $_POST["F_name"];
	$LastName= $_POST["L_name"];
	$Mobile= $_POST["Mob_Num"];
	$Address= $_POST["Address"];
	$Company= $_POST["Company_Name"];
	$Product= $_POST["Product_Name"];
	$Date=$_POST["date"];
	$Quantity=$_POST["quantity"];
	$ProDetail=$_POST["P_Detail"];
	$Problem= $_POST["Problem"];
	$Priority=$_POST["Priority"];
	$Comment=$_POST["Comment"];

	$query=0;

	////Inserting data to DBMS/////
	$sql = "INSERT INTO $db.`replacement` (`RRN`, `F_NAME`, `L_NAME`, `MOBILE_NUMBER`, `ADDRESS`, `COMPANY`, `PRODUCT`, `WARRANTY_DATE`, `QUANTITY`, `PRODUCT_DETAIL`, `PROBLEM`, `PRIORITY`, `COMMENT`) 
		VALUES
		(NULL,'$FirstName','$LastName','$Mobile','$Address','$Company','$Product','$Date','$Quantity','$ProDetail','$Problem','$Priority','$Comment')";
	$query=mysql_query($sql) or die("Query Incorrect." . mysql_error());
	$latestID= mysql_insert_id();
	/////For Status DataBase////
	$sql1 = "INSERT INTO $db.`replacement_status` (`RRN`, `STATUS`, `Explain`) 
		VALUES
		('$latestID','Pending','')";
	$query1=mysql_query($sql1) or die("Unable to feed at Status Table." . mysql_error());
	////Showing RRN TO USER.//////
	if($query && $query1)
	{
	?>
		<script type="text/javascript">alert("Thank You! Your RRN is:<?PHP echo $latestID?>");</script>
	<?PHP
	}
	$query=0;
	$sql="select * from replacement where RRN=$latestID";
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
		<td><center><h1>Amit Traders Replacement Receipt</h1></center></td>
	</tr>
	</table>
	<table id="table1">
	<tr>
		<td id="tdHeading"><b>RRN</b></td><td id="tdData"><?PHP echo $data['RRN'];?></td>
		<td id="tdHeading"><b>Date Stamp</b></td><td id="tdData"><?php echo $data['LOGGED_AT'];?></td>
	</tr>
	<tr>
		<td id="tdHeading"><b>Name</b></td><td id="tdData"><?PHP echo $data['F_NAME'];?> &nbsp; <?php echo $data['L_NAME'];?></td>
		<td id="tdHeading"><b>Address</b></td><td id="tdData"><?php echo $data['ADDRESS'];?></td>
	</tr>
	<tr>
		<td id="tdHeading"><b>Mobile Number</b></td><td id="tdData"><?PHP echo $data['MOBILE_NUMBER'];?></td>
		<td id="tdHeading"><b>Company/Product</b></td><td id="tdData"><?php echo $data['COMPANY'];?>/<?PHP echo $data['PRODUCT'];?></td>
	</tr>
	<tr>
		<td id="tdHeading"><b>Billing Date</b></td><td id="tdData"><?PHP echo $data['WARRANTY_DATE'];?></td>
		<td id="tdHeading"><b>Quantity</b></td><td id="tdData"><?php echo $data['QUANTITY'];?></td>
	</tr>
	<tr>
		<td id="tdHeading"><b>Problem</b></td><td id="tdData"><?PHP echo $data['PROBLEM'];?></td>
		<td id="tdHeading"><b>Comment</b></td><td id="tdData"><?php echo $data['COMMENT'];?></td>
	</tr>
	<tr>
		<td id="tdHeading"><b>Details</b></td><td id="tdData"><?PHP echo $data['PRODUCT_DETAIL'];?></td>
		<td id="tdHeading"><b>Signature</b></td><td id="tdData"></td>
	</tr>
	</table>
	</div>	<input type="button"value="PRINT" onclick="window.print()">
	<a href="New_Replacement.php"><button>Back</button></a>
	</form></center></body></html>
	<?PHP
	unset($_SESSION['NewEntry']);
	session_destroy();
	}
	else
	echo "Sorry Print Slip cant not be formed!!.";
}
else
{
	Echo "<font color='red'>Session Voilated!</font><br> <a href='New_Replacement.php'><b>ReEntry</b></a>";
	unset($_SESSION['NewEntry']);
	session_destroy();
}
?>