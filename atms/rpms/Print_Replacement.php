
<?PHP
	include('../includes/header.php'); 
	require ('../database/dbconnect.php');
?>
<html>
   <head>
    <script src="../printDiv.js" type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
	}

	</script>
   </head>
<body width="700px" height="700px">
   <table align="center">
	<tr>
		<td>
			<div style="height: 30px;">
				<?PHP include('RPMS_Menu.php');?>
			</div>
		</td>
	</tr>
</table><br><br>
			<?PHP	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$RRN= $_POST['RRN'];
		if(!preg_match("/^[0-9]*$/", $RRN))
		$RRNERR="Only Digit Allow.";
		else
		{
			$sql="select * from replacement inner join replacement_status where replacement.RRN='$RRN' and replacement.RRN=replacement_status.RRN";
			$query=mysql_query($sql) or die("Unable to fetch data to print slip. <br>" . mysql_error());
			$result=mysql_num_rows($query);
			if($result>0)
			{
				$data= mysql_fetch_array($query);
			?>
			

   
		
		
		
	<form><center>
		<div id="printableArea">
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
				<td id="tdHeading"><b>Name</b></td><td id="tdData"><?PHP echo $data['F_NAME'];?> <?php echo $data['L_NAME'];?></td>
				<td id="tdHeading"><b>Address</b></td><td id="tdData"><?php echo $data['ADDRESS'];?></td>
			</tr>
			<tr>
				<td id="tdHeading"><b>Mob.No.</b></td><td id="tdData"><?PHP echo $data['MOBILE_NUMBER'];?></td>
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
				<td id="tdHeading"><b>Status</b></td><td id="tdData"><?PHP echo $data['STATUS'];?></td>
			</tr>
			<tr>
				<td id="tdHeading"><b>Action</b></td><td id="tdData"><?PHP echo $data['EXPLAIN'];?></td>
				<td id="tdHeading"><b>Action Date</b></td><td id="tdData"><?php echo $data['ALTERED_AT'];?></td>
			</tr>
			
			</table>
			</div>
			</form></center>
		</div>
		<center><input type="button" onclick="printDiv('printableArea')" value="Print" />
		</center></body>
	<?PHP
			}
				else	
				echo "<font color='RED' size='5'>Sorry RRN not found!</font>";
		}
	}
if($reslut==0)
	{
	?>	
		<html>
		<center><h1>Re-Print Replacement Slip</h1>
		<div  style="border: 1px solid black; bgcolor:#F088F; position:center; width:400px; margin:10px; padding:10px">
		<form method="POST" action="<?PHP echo htmlspecialchars($_Server['php_self']);?>">
		<table>
		<tr>
			<td> RRN </td>
			<td><input type="text" size="25" name="RRN"><span id="error"><?PHP echo $RRNERR;?></span></td>
		</tr>
		<tr>
			<td> &nbsp;</td>
			<td><input type="Submit" value="Make Slip" name="Submit"></td>
		</tr></table></div></center></html>
<?PHP
	}
?>
</html>