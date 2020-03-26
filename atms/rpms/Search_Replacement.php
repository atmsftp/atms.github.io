<html>
<?php 
include('../includes/header.php');
require('../database/dbconnect.php');
$Saver=0;
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
<table align="center">
	<tr>
		<td>
			<div style="height: 30px;">
				<?PHP include('RPMS_Menu.php');?>
			</div>
		</td>
	</tr>
</table>
			<?PHP
			
if($_SERVER["REQUEST_METHOD"]=="POST")
	{
					$entryCheck='';
					$empty=0;
					$checker=0; //Checks if one pregMatch is true and other search database keyword is valid.
					
				$RRN=test_input($_POST["RRN"]);
				if(!empty($RRN))
				{
					if(!preg_match("/^[0-9]*$/", $RRN))
					{
					$RRNErr="*Not Valid";
					$checker++;
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
						$mobilenumberErr="*Not Valid";
						$checker++;
					}
					else
					{
						$Saver++;
					}
				}
				else
				$empty++;
			
			
				$firstname=test_input($_POST["F_name"]);
				if(!empty($firstname))
				{
					if(!preg_match("/^[a-zA-Z]*$/",$firstname))
					{
						$nameErr="*Only Letters Allowed!";
						$checker++;
					}
					else
					{
						$Saver++;
					}
					
				}
				else
				$empty++;
			
			
				$lastname=test_input($_POST["L_name"]);
				if(!empty($lastname))
				{
						if(!preg_match("/^[a-zA-Z]*$/",$lastname))
						{
							$lnameErr="*Only Letters Allowed!";
						}
				}
	
				
				if($Saver!=0 && $checker==0)
				{
					//////////DataBase Code Goes Here./////////
					if(!empty($RRN))
						$sql= "SELECT * FROM replacement inner join replacement_status where replacement.RRN=replacement_status.RRN and replacement.RRN=$RRN ORDER BY `replacement`.`RRN` DESC";
					elseif(!empty($mobNumber))
						$sql= "SELECT * FROM replacement inner join replacement_status where replacement.RRN=replacement_status.RRN and replacement.Mobile_Number=$mobNumber ORDER BY `replacement`.`RRN` DESC";
					elseif(!empty($firstname))
						$sql= "SELECT * FROM replacement inner join replacement_status where replacement.RRN=replacement_status.RRN and replacement.F_Name='$firstname' ORDER BY `replacement`.`RRN` DESC";
				
					$query= mysql_query($sql) or die("Unable to fetch Data." . mysql_error());
					$count=mysql_num_rows($query);
					if($count>0)
					{	
				?>
						<h1><u>Replacement Search Result</u></h1><br>
					
						<font color="BLUE" size="5">Found <font Size="6" color="Green"><?PHP echo $count;?></font> Records.</font><br>
						<div id="Search" align="center">
						<table align="center" style=" text-align: center; width: 1280px; border: 1px solid black; border-collapse: collapse;">
						<tr bgcolor="#F0F8FF">
							<th id="SearchData">RRN</th>
							<th id="SearchData">Priority</th>
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
								<td><?PHP echo $data['RRN'];?></td>
								<td bgcolor="<?PHP echo (checkColor($data['PRIORITY']));?>"><?PHP echo $data['PRIORITY'];?></td>
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
						echo "</table></div><center>";
						echo "<a href='Search_Replacement.php'><button>BACK</button></a></center>";
					}
					Else
						echo "<font color='RED' size='5'>Record NOT Found.</font><br><a href='Search_Replacement.php'><button>BACK</button></a>";
				}
			elseif($empty==3)
					$entryCheck="Enter either RRN or Mobile Number or First Name.<br>";	
			
	}
?>

<html>
<table width="100%" height="2%" border="0px">
	<tr>
		<td style="textalign:left"><a href="Search_Replacement.php"><font color="Yellow" size="6">Refresh</font></a></td><td>&nbsp;</td>
	</tr>
</table><br>
<font size="5">-:Search:-</font><br><br>

<form method="POST" action="<?PHP  echo htmlspecialchars($_Server['php_self']);?>">
<table height="5%" width="100%" align="center">
 <tr>
		<span id="error"><?php echo $entryCheck;?></span>
	<td>Replacement Number*:<input type="text" name="RRN" size="5"value="<?PHP echo $RRN;?>"><span id="error"><?php echo$RRNErr?></span><font color="RED">OR</font></td>
		<td>Mob.NO.*: <input type="text" name="mobNumber" size="10" maxlength="10" value="<?PHP echo $mobNumber;?>"><span id="error"><?php echo $mobilenumberErr?></span><font color="RED">OR</font></td>
		<td>First Name:<input name="F_name" type="text" size="15" value="<?php echo $firstname;?>"><span id="error"><?php echo $nameErr?></span></td>
		<td>Last Name: <input name="L_name" type="text"size="15" value="<?PHP echo $lastname;?>"><span id="error"><?php echo $lnameErr?></span></td>
	</tr>
</table><br><br>
<center><input type="Submit" size="30" value="Search Replacement"/></center>
</form>
</html>


