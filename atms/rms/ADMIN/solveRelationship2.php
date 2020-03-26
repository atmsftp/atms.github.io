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
	$month= date('F_Y', strtotime(date('Y-m')." -1 month"));
	echo $month;
	
	/*echo date('m', strtotime(date('Y-m')." -1 month"));*////Method To get Prious Month and year(Replace 'm' wiht 'Y')
	if(!empty($_SESSION['UniqueID']))
	{
		$sql="SELECT * from pendencybuffer";
		$query=mysql_query($sql) or die ("Error Connecting to the Database.". mysql_error());
		$count=mysql_num_rows($query);
		
		if($count>0)
		{
?>
			<font size="5" id="SearchData" background="yellow">Total Number of People:</font> <b><?php echo $count;?></b><br>
	
			<div id="Search" align="center">
						<form action="actionReplacement.php" method="POST">
						<table  align="center" style=" text-align: center; width: 1280px; border: 1px solid black; border-collapse: collapse;">
						<tr bgcolor="#F0F8FF">
							<th id="SearchData">0-20</th>
							<th id="SearchData">20-40</th>
							<th id="SearchData">40-60</th>
							<th id="SearchData">60-80</th>
							<th id="SearchData">80-100</th>
							<th id="SearchData">100-120</th>
							<th id="SearchData">120-140</th>					
							<th id="SearchData">140-160</th>
							<th id="SearchData">160-180</th>
							<th id="SearchData">180-200</th>
							<th id="SearchData">200-220</th>
							<th id="SearchData">220-240</th>
							<th id="SearchData">240-260</th>
							<th id="SearchData">260-280</th>
							<th id="SearchData">280-300</th>
							<th id="SearchData">300-320</th>
							<th id="SearchData">320-340</th>
							<th id="SearchData">340-360</th>
						</tr>
						
	<?PHP
			while($data=mysql_fetch_array($query))
						{
	?>
							<tr bgcolor="<?PHP echo (checkColor($data['PRIORITY']));?>" style="border: 1px solid black;">
								<td><input type="Submit" value="<?PHP echo $data['RRN'];?>" name="RRN"></td>
								<td><?PHP echo $data['F_NAME'];?></td>
								<td><?PHP echo $data['MOBILE_NUMBER'];?></td>
								<td><?PHP echo $data['COMPANY']; echo '/'; echo $data['PRODUCT'];?></td>
								<td><?PHP echo $data['QUANTITY'];?></td>
								<td><?PHP echo $data['PRODUCT_DETAIL'];?></td>
								<td><?PHP echo $data['PROBLEM'];?></td>								
								<td><?PHP echo $data['COMMENT'];?></td>
								<td><?PHP echo $data['LOGGED_AT'];?></td>
								<td><?PHP echo $data['STATUS'];?></td>
								<td><?PHP echo $data['ALTERED_AT'];?></td>
								<td><?PHP echo $data['EXPLAIN'];?></td>
							</tr>
	<?PHP
						}
				echo "</table></form></div>";
			
		}
	}
	else
	{
	echo "<font color='red' size='5'> Session Voilated!</font><br><a href='Admin_replacement.php'><button>ReLogin</button></a>";
	 unset($_SESSION['UniqueID']);
	 session_destroy();
	}
	?>