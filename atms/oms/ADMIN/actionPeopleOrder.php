<?PHP
session_start();
error_reporting(0);
include ("../../includes/header.php");
require("../../database/dbconnect.php");

	if($_SERVER["REQUEST_METHOD"]== "POST")
		{
	
		$ORN=$_POST['ORN'];
		$submit=$_POST['Submit'];
		}
		
			function test_input($data)
				{
					$data=trim($data);
					$data=stripslashes($data);
					$data=htmlspecialchars($data);
					return $data;
				}


		function Color($color)
				{
					return '#F008F0';
					
				}
	
	

				
	if(!empty($submit))
	{
		$action= test_input($_POST['action']);
		if(empty($action))
			$actionErr="Field Required!";
		else
		{
			/////DataBase Entry goes here!//////
			$status=$_POST['Status'];
			$sql="UPDATE order_status SET order_status.EXPLAIN='$action', order_status.STATUS='$status' WHERE order_status.ORN='$ORN'";
			$query=mysql_query($sql) or die("ERROR INSERTING DATA TO DATABASE". mysql_error());
			if($query)
			{
				echo "<script type='text/javascript'>alert('Thank you. Data Modified!');</script>";
				$_SESSION['UniqueID']=uniqid();
				?><div bgcolor="#F090F6"><?PHP require('solvePeopleOrder.php');?></div><?PHP
				
			}
			
			
			
		}
	}	
	
		echo "<center><h1><font color='BLUE'>Admin ORN#". $ORN."</center></font></h1><br>";
		$sql="SELECT * from `order` INNER JOIN order_status where order.ORN= '$ORN' and order.ORN=order_status.ORN";
		$query=mysql_query($sql) or die ("Error Connecting to the Database.". mysql_error());
		$data=mysql_fetch_array($query);
?>
		<form action="<?PHP echo htmlspecialchars($_Server['php_self']);?>" method="POST">
		<div id="Search" align="center">
		<table  align="center" style=" text-align: center; width: 1280px; border: 1px solid black; border-collapse: collapse;">
						<tr bgcolor="#F0F8FF">
							<th id="SearchData">ORN</th>
							<th id="SearchData">Title</th>
							<th id="SearchData">Full Name</th>
							<th id="SearchData">Mobile Number</th>
							<th id="SearchData">Order Type</th>
							<th id="SearchData">Order</th>
							<th id="SearchData">Comment</th>
							<th id="SearchData">Order Date</th>
							<th id="SearchData">Status</th>
							<th id="SearchData">Action Date</th>
							<th id="SearchData">Action</th>
						</tr>
						<tr bgcolor="<?PHP echo (Color($data['PRIORITY']));?>" style="border: 1px solid black;">
								<td><?PHP echo $data['ORN'];?></td>
								<input type="hidden" name="ORN" value="<?PHP echo $ORN;?>">
								<td><?PHP echo $data['TITLE'];?></td>
								<td><?PHP echo $data['NAME'];?></td>
								<td><?PHP echo $data['MOBILE_NUMBER'];?></td>
								<td><?PHP echo $data['TYPE'];?></td>
								<td><?PHP echo $data['ORDER'];?></td>
								<td><?PHP echo $data['COMMENT'];?></td>
								<td><?PHP echo $data['TIMESTAMP'];?></td>
								<td><?PHP echo $data['STATUS'];?></td>
								<td><?PHP echo $data['AlterDate'];?></td>
								<td><?PHP echo $data['EXPLAIN'];?></td>
						</tr>
						
						<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><b>Status: </b></td><td><select name="Status" size=1>
															<option value="Pending">Pending
															<option value="Resolved">Resolved
															</option>
															</select></td>
								<td><b>Action Taken: </b></td><td><textarea name="action" size="35"></textarea><span id="error"> <?PHP echo $actionErr;?></span></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
						</tr>
						<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>								
								<td><input type="Submit" name="Submit" value="Submit"></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								
						</tr>
						
		</table></form></div>
