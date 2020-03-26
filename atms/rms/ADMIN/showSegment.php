<?PHP
include ("../../includes/header.php");
require("../../database/dbconnect.php");
$start=$_POST['start'];
$end=$_POST['end'];
$Tpeople=$_POST['people'];
$Tamount=$_POST['amount'];

?>
<html>
<head>
<style type="text/css">
#table-wrapper {
  position:relative;
}
#table-scroll {
  height:500px;
  overflow:auto;  
  
}
</style>
<script src= "../../printDiv.js" type="text/javascript">

</script>
</head>
		


<?PHP
	$sql="SELECT * from pendencybuffer where Amount > $start*1000 and Amount < $end*1000+1 order by Amount DESC";
		
		$query=mysql_query($sql) or die ("Error Connecting to the Database.". mysql_error());
		$count=mysql_num_rows($query);
		
		if($count>0)
		{
?>
		<div id="printableArea">
		<center><b><i> <?PHP echo "SHOWING: <font color='#778899' size='4'>$start,000 To $end,000,</font> TOTAL PEOPLE: <font color='#778899' size='4'>$Tpeople,</font> TOTAL AMOUNT: <font color='#778899' size='4'>$Tamount, </font>";?></b></i></center>
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
		</div>
		
			<center>
			<input type="button" onclick="printDiv('printableArea')" value="Print" /> 
			</center>
		
	<?PHP		
		}
			Else
				Echo "<H2><font color= 'RED'>No Records Found!!</font></H2>";
	
	?>
		
</html>

