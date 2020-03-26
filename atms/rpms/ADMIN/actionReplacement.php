<?PHP
session_start();
error_reporting(0);
include ("../../includes/header.php");
require("../../database/dbconnect.php");

	if($_SERVER["REQUEST_METHOD"]== "POST")
		{
	
		$RRN=$_POST['RRN'];
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
			$sql="UPDATE replacement_status SET replacement_status.Explain='$action', replacement_status.STATUS='$status' WHERE replacement_status.RRN='$RRN'";
			$query=mysql_query($sql) or die("ERROR INSERTING DATA TO DATABASE". mysql_error());
			if($query)
			{
				echo "<script type='text/javascript'>alert('Thank you. Data Modified!');</script>";
				$_SESSION['UniqueID']=uniqid();
				?><div bgcolor="#F090F6"><?PHP require('solveReplacement.php');?></div><?PHP
				
			}
			
			
			
		}
	}	
	
		echo "<center><h1><font color='BLUE'>Admin RRN#". $RRN."</center></font></h1><br>";
		$sql="SELECT * from replacement INNER JOIN replacement_status where replacement.RRN= '$RRN' and replacement.RRN=replacement_status.RRN";
		$query=mysql_query($sql) or die ("Error Connecting to the Database.". mysql_error());
		$data=mysql_fetch_array($query);
?>
		<form action="<?PHP echo htmlspecialchars($_Server['php_self']);?>" method="POST">
		<div id="Search" align="center">
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
						<tr bgcolor="<?PHP echo (Color($data['PRIORITY']));?>" style="border: 1px solid black;">
								<td><?PHP echo $data['RRN'];?></td>
								<input type="hidden" name="RRN" value="<?PHP echo $RRN;?>">
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
