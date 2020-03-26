<html>
<head>
<script src= "../../printDiv.js" type="text/javascript">

</script>
</head>
<body>
<tr>
<td><a href="../ADMIN/UploadPendency.php"><button><Font color="Black" size="3">Upload Pendency</font></button></a></td>
</tr>
<center>
		<table>
		<tr>
			
			<td><a href="../RMS_Menu.php"><button onclick="session_destroy();">Log Out</button></a></td>

		</tr>
	</table>
	</center>
<?PHP
	
	include ("../../includes/header.php");
	require("../../database/dbconnect.php");
		
		if(!empty($_SESSION['UniqueID']))
	{
		$sql="SELECT * from pendencyrecord order by pid DESC";
		
		$query=mysql_query($sql) or die ("Error Connecting to the Database.". mysql_error());
		$count=mysql_num_rows($query);
		
		if($count>0)
		{
?>
			<div id="printableArea">
				<font id="SearchData" size="4">Total Number of Records Found:  <b><font color="yellow"><?php echo $count;?></font></b></font><br>
	
					<div id="Search" align="center">
						<form action="analyzePendency.php" method="POST">
						<table  align="center" style=" text-align: center; width: 1280px; border: 1px solid black; border-collapse: collapse;">
						<tr bgcolor="yellow"; style="border: 2px solid black;">
							<th id="SearchData">Month & Year</th>
							<th id="SearchData">Total Number of People</th>
							<th id="SearchData">Total Amount</th>
						</tr>
					
	<?PHP
					$Check=1;
					while($data=mysql_fetch_array($query))
						{
	?>
							<tr bgcolor="#F0F8FF"; style="border: 2px solid black;">
								<td>
							<?PHP	if($Check==1){?>
								<input type="Submit" value="<?PHP echo $data['MonthYear'];?>" name="MonthYear">
							<?PHP $Check=0;}
									else
										echo $data['MonthYear'];
							?>
								</td>
								<td><?PHP echo $data['TNP'];?></td>
								<td><?PHP echo $data['TAmount'];?></td>
								
							</tr>
	<?PHP
						}
				echo "</table></form></div>";
				?></div>
				<center><input type="button" onclick="printDiv('printableArea')" value="Print" />  </center>
	<?PHP		
		}
	}
	else
	{
	echo "<font color='red' size='5'> Session Voilated!</font><br><a href='Admin_replacement.php'><button>ReLogin</button></a>";
	 unset($_SESSION['UniqueID']);
	 session_destroy();
	}
	?>
	</body>
</html>