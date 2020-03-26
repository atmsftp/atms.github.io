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
				$ORN=test_input($_POST["ORN"]);
				if(!empty($ORN))
				{
					if(!preg_match("/^[0-9]*$/", $ORN))
					{
					$ORNErr="*Not Valid";
					}
					else
					$Saver++;
				}
				else
					$empty++;
				
			
				$mobNumber=test_input($_POST["mobNumber"]);
				if(!empty($mobNumber))
				{
					if (!preg_match("/^\d{10}$/", $mobNumber))
					{
						$MobileErr="*Not Valid";
					}
					else
					{
						$Saver++;
					}
				}
				else
				$empty++;
				
		if($empty==2)
				{
					$Valid="Enter Either ORN or Mobile Number!";
				}
}
?>
<html>
	<head>
	<script type="text/javascript">
		function select1()
		{
		  document.location= "SearchShoporder.php";
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
										<option value="Other">Other
										<option value="My Shop">My Shop
										</select>

<form method="POST" action="<?PHP echo htmlspecialchars($_Server['php_self']);?>">
<span id="error"><?PHP echo $Valid; ?></span>
<table height="5%" width="100%" align="center">
	<tr>
		
		<td>Order Number*:<input type="text" name="ORN" size="15" value="<?PHP echo $ORN;?>"><span id="error"> <?PHP echo $ORNErr;?></span>&nbsp;&nbsp;OR</td>
		<td>Mobile Number*: <input type="text" name="mobNumber" size="15" maxlength="10" value="<?PHP echo $mobNumber;?>"><span id="error"><?php echo $MobileErr;?></span></td>
	</tr>
</table><br><br>
<center><input type="Submit" size="30" value="Search Order"/></center>
</form></html>

<?PHP		
	
		if($Saver>0)
			{
				if(!empty($ORN))
					$sql= "SELECT * FROM `order` inner join `order_status` where `order`.ORN=`order_status`.ORN and `order`.ORN=$ORN ORDER BY `order`.`ORN` DESC";
			
				elseif(!empty($mobNumber))
					$sql= "SELECT * FROM `order` inner join `order_status` where `order`.ORN=`order_status`.ORN and `order`.MOBILE_NUMBER=$mobNumber ORDER BY `order`.`ORN` DESC";
			
							
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
				<?PHP
						while($data=mysql_fetch_array($query))
						{
				?>
							<tr bgcolor="<?PHP echo (checkColor($data['PRIORITY']));?>" style="border: 1px solid black;">
								<td><?PHP echo $data['ORN'];?></td>
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
					<?PHP
						}
						echo "</table></div><center>";
					}
					Else
						echo "<font color='RED' size='5'>Record NOT Found.</font><br>";
			}
			else
				{
					$sql="SELECT * from `order` INNER JOIN order_status where `order`.ORN=order_status.ORN and order_status.STATUS='Pending' ORDER BY `order`.ORN";
					$query=mysql_query($sql) or die ("Error Connecting to the Database.". mysql_error());
					$count=mysql_num_rows($query);
					if($count>0)
					{
					?>
						<div id="Search" align="center">
						<table align="center" style=" text-align: center; width: 1280px; border: 1px solid black; border-collapse: collapse;">
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
						</tr>
				<?PHP
						while($data=mysql_fetch_array($query))
						{
				?>
							<tr bgcolor="<?PHP echo (checkColor($data['PRIORITY']));?>" style="border: 1px solid black;">
								<td><?PHP echo $data['ORN'];?></td>
								<td><?PHP echo $data['TITLE'];?></td>
								<td><?PHP echo $data['NAME'];?></td>
								<td><?PHP echo $data['MOBILE_NUMBER'];?></td>
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
	
