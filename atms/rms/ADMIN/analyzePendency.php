<?PHP
include ("../../includes/header.php");
require("../../database/dbconnect.php");
?>
<html>
<head>
<script src="../../printDiv.js" type="text/javascript">
</script>
<style type="text/css">
#table-wrapper {
  position:relative;
}
#table-scroll {
  height:500px;
  overflow:auto;  
  
}
</style>
</head>



<!-- **********************************************************  PART-2  ********************************************************* -->
<?PHP
	if(isset($_POST['Analyse']))
	{
		echo 
		'<tr>
			<td style="textalign: left"><font color="yellow" size="4"><b>Analysis of Pendency.</b></td>
		</tr>';
		$data=mysql_query("Select SUM(Amount) as total_amount From pendencybuffer");
							$total=mysql_fetch_assoc($data);
							$Amount=$total['total_amount'];
		$sql=mysql_query("SELECT Amount from pendencybuffer order by Amount DESC");
		$data=mysql_fetch_assoc($sql);
		$TNP=mysql_num_rows($sql);
		$loop=ceil($data['Amount']/20000);
		
?>
	<form action="showSegment.php" method="POST">
		<div id="printableArea">
				<center><b><i> <?PHP echo "<font color='#778899' size='4'>TOTAL PEOPLE: <font color='#778899' size='4'>$TNP,</font> TOTAL AMOUNT: <font color='#778899' size='4'>$Amount </font>";?></b></i></center>
			<div id="Search" align="center" id="table-wrapper">
				<div id="table-scroll">
					
					<table  align="center" style=" text-align: center; width: 700px;  border: 1px solid black; border-collapse: collapse;">
						<tr bgcolor="yellow"; style="border: 2px solid black;"height="50px">
							<th id="SearchData">Scale (in thousand)</th>
							<th id="SearchData">Number of People</th>
							<th id="SearchData">Amount</th>
							<th id="SearchData">Percentage (%)</th>
						</tr>					
	<?PHP
						$i=0; $j=20;
						
						while($loop>0)
						{
							$data=mysql_query("Select SUM(Amount) as total_amount From pendencybuffer where Amount > ($i*1000) and Amount < ($j*1000+1)");
							$total=mysql_fetch_assoc($data);
							$Amount=$total['total_amount'];
							
							$data=mysql_query("Select * From pendencybuffer where Amount > ($i*1000) and Amount < ($j*1000+1)");
							$people=mysql_num_rows($data); 
							$percentage=(($people*100)/$TNP); 
	 ?>
							<tr bgcolor="#F0F8FF"; style="border: 2px solid black;" height="50px">
								<td><form action="showSegment.php" method="POST">
								<input type="hidden" name="start" value="<?PHP echo $i;?>">
								<input type="hidden" name="end" value="<?PHP echo $j;?>">
								<input type="hidden" name="people" value="<?PHP echo $people;?>">
								<input type="hidden" name="amount" value="<?PHP echo $Amount;?>">
								<input type="Submit" value="<?php echo $i,'-', $j;?>">
								</form></td> 								
								<td><?PHP echo $people;?></td>
								<td><?PHP echo $Amount;?></td>
								<td><?PHP echo number_format((float)$percentage, 2, '.', '').'%';?></td>
												
							</tr>
	<?PHP
								$i=$j;
								$j=$j+20;
								$loop--;
						}
	?>					</table>
					</form>
				</div>
			</div>  
			</div>
			<center><input type="button" onclick="printDiv('printableArea')" value="Print" />  </center>
	<?PHP
				
	}
else
	{
?>




<!--********************************************************    PART-1    *************************************************************************** -->

		<tr>
			<td style="textalign: left"><font color="yellow" size='4'>All Pendency Detail</td>
			<td><form action="<?PHP $_SERVER['PHP_SELF'];?>" method="POST"><input type="SUBMIT" name="Analyse" value="Analze Data!"></form></td>
		</tr>


<?PHP
$sql="SELECT * from pendencybuffer order by Amount DESC";
		
		$query=mysql_query($sql) or die ("Error Connecting to the Database.". mysql_error());
		$count=mysql_num_rows($query);
		
		if($count>0)
		{
?>
			<div id="Search" align="center" id="table-wrapper">
				<div id="table-scroll">
					<table  align="center" style=" text-align: center; width: 900px;  border: 1px solid black; border-collapse: collapse;">
						<tr bgcolor="yellow"; style="border: 2px solid black;">
							<th id="SearchData">S.No.</th>
							<th id="SearchData">Name</th>
							<th id="SearchData">Contact Number</th>
							<th id="SearchData">Amount</th>
						</tr>					
	<?PHP
			$Sn=1;
			while($data=mysql_fetch_array($query))
						{
	?>
							<tr bgcolor="#F0F8FF"; style="border: 2px solid black;">
								<td><?PHP echo $Sn;?></td>
								<td><?PHP echo $data['Name'];?></td>
								<td><?PHP echo $data['Number'];?></td>
								<td><?PHP echo $data['Amount'];?></td>
								
							</tr>
	<?PHP
							$Sn++;
						}
	?>					</table>
				</div>
			</div>
	<?PHP		
		}
			Else
				Echo "<H2><font color= 'RED'>No Records Found!!</font></H2>";
	}
	?>
		
</html>

