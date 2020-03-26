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
		$sql="SELECT * from `shoporder` INNER JOIN shoporder_status where shoporder.SORN=shoporder_status.SORN and shoporder_status.STATUS='Pending' ORDER BY shoporder.SORN";
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
			<td><h1><u>Order Administration</u></h1></td>
			<td><a href="Admin_Order.php"><button onclick="session_destroy();">Log Out</button></a></td>
		</tr>
	</table>
	</center>
	<?PHP
		echo $countmsg;
		if($count>0)
		{
	?>
			<div id="Search" align="center">
						<form action="actionShopOrder.php" method="POST">
						<table  align="center" style=" text-align: center; width: 1280px; border: 1px solid black; border-collapse: collapse;">
						<tr bgcolor="#F0F8FF">
							<th id="SearchData">SORN</th>
							<th id="SearchData">Order Type</th>
							<th id="SearchData">Order</th>
							<th id="SearchData">Comment</th>
							<th id="SearchData">Order Date</th>
							<th id="SearchData">Status</th>
							<th id="SearchData">Action Date</th>
							<th id="SearchData">Action</th>
						</tr>
						
	<?PHP
			while($data=mysql_fetch_array($query))
						{
	?>
							<tr bgcolor="<?PHP echo (checkColor($data['PRIORITY']));?>" style="border: 1px solid black;">
								<td><input type="Submit" value="<?PHP echo $data['SORN'];?>" name="SORN"></td>
								<td><?PHP echo $data['TYPE'];?></td>
								<td><?PHP echo $data['ORDER'];?></td>
								<td><?PHP echo $data['COMMENT'];?></td>
								<td><?PHP echo $data['TIMESTAMP'];?></td>
								<td><?PHP echo $data['STATUS'];?></td>
								<td><?PHP echo $data['ALTERED_AT'];?></td>
								<td><?PHP echo $data['DETAILS'];?></td>
							</tr>
	<?PHP
						}
				echo "</table></form></div>";
			
		}
	}
	else
	{
	echo "<font color='red' size='5'> Session Voilated!</font><br><a href='Admin_Order.php'><button>ReLogin</button></a>";
	 unset($_SESSION['UniqueID']);
	 session_destroy();
	}
	?>