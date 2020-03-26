<?PHP
	
	include ("../../includes/header.php");
	require("../../database/dbconnect.php");
	function checkColor($color)
				{
			
					if($color=='High')
						return 'RED';
					elseif($color=='Medium')
						return 'YELLOW';
					else
						return 'GREEN';
				}
	
	if(!empty($_SESSION['UniqueID']))
	{
		$sql="SELECT * from replacement INNER JOIN replacement_status where replacement.RRN=replacement_status.RRN and replacement_status.STATUS='Pending' ORDER BY replacement.RRN";
		$query=mysql_query($sql) or die ("Error Connecting to the Database.". mysql_error());
		$count=mysql_num_rows($query);
		
		if($count>0)
			$countmsg="<font color='blue' size='5'>These <font color='green' size='6'>$count</font> records need attention.</font> ";
		else
			$countmsg="<font color='blue' size='5'>Relax! No record need Attention.</font>";
?>
		<center>
		<table>
		<tr>
			<td><h1><u>Replacement Administration</u></h1></td>
			<td><a href="../RPMS_Menu.php"><button onclick="session_destroy();">Log Out</button></a></td>
		</tr>
	</table>
	</center>
	<?PHP
		echo $countmsg;
		if($count>0)
		{
	?>
			<div id="Search" align="center">
						<form action="actionReplacement.php" method="POST">
						<table  align="center" style=" text-align: center; width: 1280px; border: 1px solid black; border-collapse: collapse;">
						<tr bgcolor="#F0F8FF">
							<th id="SearchData">RRN</th>
							<th id="SearchData">Name</th>
							<th id="SearchData">Mobile Number</th>
							<th id="SearchData">Company/Product</th>
							<th id="SearchData">Quantity</th>
							<th id="SearchData">Details</th>
							<th id="SearchData">Problem</th>					
							<th id="SearchData">Comment</th>
							<th id="SearchData">Complaint Date</th>
							<th id="SearchData">Status</th>
							<th id="SearchData">Action Date</th>
							<th id="SearchData">Action</th>
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