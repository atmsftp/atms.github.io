<?php 
include('../includes/header.php'); 
require ('../database/dbconnect.php');
$Valid='';
$Saver=$empty=0;
		function test_input($data)
				{
					$data=trim($data);
					$data=stripslashes($data);
					$data=htmlspecialchars($data);
					return $data;
				}
		function checkColor($color)
				{
			
					if($color=='High')
						return 'RED';
					elseif($color=='Medium')
						return 'YELLOW';
					else
						return 'GREEN';
				}
?>
<?PHP
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
					
					
					
				$SORN=test_input($_POST["SORN"]);
				if(!empty($SORN))
				{
					if(!preg_match("/^[0-9]*$/", $SORN))
					{
					$SORNErr="*Not Valid";
					}
					else
					$Saver++;
				}
				else
					$empty++;
		if($empty==1)
				{
					$Valid="Enter Shop Order Number!";
				}
	}
?>
<html>
	<head>
	<script type="text/javascript">
		function select1()
		{
			document.location= "Search_Order.php";
		}
	</script>
	</head>
<table align="center">
	<tr>
		<td>
			<div style="height: 30px;">
				<?PHP include('OMS_Menu.php');?>
			</div>
		</td>
	</tr>
</table><br>
<font size="5"><b>-:Search:-</b></font><select name="Title" size='1' id="TYPE" onchange="select1()">
										<option value="My Shop">My Shop
										<option value="Other">Other
										</select>

<form method="POST" action="<?PHP echo htmlspecialchars($_Server['php_self']);?>">
<span id="error"><?PHP echo $Valid; ?></span>
<table height="5%" width="100%" align="center">
	<tr>
		
		<td><b>Shop Order Number*:</b><input type="text" name="SORN" size="15" value="<?PHP echo $SORN;?>"><span id="error"> <?PHP echo $SORNErr;?></span></td>
	</tr>
</table><br><br>
<center><input type="Submit" size="30" value="Search Order"/></center>
</form></html>

<?PHP
	if($Saver>0)
	{
					if(!empty($SORN))
						$sql= "SELECT * FROM `shoporder` inner join `shoporder_status` where `shoporder`.SORN=`shoporder_status`.SORN and `shoporder`.SORN=$SORN ORDER BY `shoporder`.`SORN` DESC";
							
					$query= mysql_query($sql) or die("Unable to fetch Data." . mysql_error());
					$count=mysql_num_rows($query);
					if($count>0)
					{	
				?>
						<h1><u>Order Search Result</u></h1><br>
					
						<font color="BLUE" size="5">Found <font Size="6" color="Green"><?PHP echo $count;?></font> Records.</font><br>
						<div id="Search" align="center">
						<table align="center" style=" text-align: center; width: 1280px; border: 1px solid black; border-collapse: collapse;">
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
								<td><?PHP echo $data['SORN'];?></td>
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
						echo "</table></div><center>";
					}
					Else
						echo "<font color='RED' size='5'>Record NOT Found.</font><br>";
			
			
					
	}
	else
	{
		$sql="SELECT * from `shoporder` INNER JOIN shoporder_status where `shoporder`.SORN=shoporder_status.SORN and shoporder_status.STATUS='Pending' ORDER BY `shoporder`.SORN";
		$query=mysql_query($sql) or die ("Error Connecting to the Database.". mysql_error());
		$count=mysql_num_rows($query);
		if($count>0)
		{
			?>
			<div id="Search" align="center">
						<table align="center" style=" text-align: center; width: 1280px; border: 1px solid black; border-collapse: collapse;">
						<tr bgcolor="#F0F8FF">
							<th id="SearchData">SORN</th>
							<th id="SearchData">Order Type</th>
							<th id="SearchData">Order</th>
							<th id="SearchData">Comment</th>
							<th id="SearchData">Order Date</th>
							<th id="SearchData">Status</th>
						</tr>
				<?PHP
						while($data=mysql_fetch_array($query))
						{
				?>
							<tr bgcolor="<?PHP echo (checkColor($data['PRIORITY']));?>" style="border: 1px solid black;">
								<td><?PHP echo $data['SORN'];?></td>
								<td><?PHP echo $data['TYPE'];?></td>
								<td><?PHP echo $data['ORDER'];?></td>
								<td><?PHP echo $data['COMMENT'];?></td>
								<td><?PHP echo $data['TIMESTAMP'];?></td>
								<td><?PHP echo $data['STATUS'];?></td>
							</tr>				
					<?PHP
						}
						echo "</table></div><center>";	
		}
	}
	?>