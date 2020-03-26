<?PHP
session_start();
$_SESSION['NEWORDER']=uniqid();
include('../includes/header.php'); 
require ('../database/dbconnect.php');
function test_input($data)
				{
					$data=trim($data);
					$data=stripslashes($data);
					$data=htmlspecialchars($data);
					return $data;
				}
	$button="Submit";
	
if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$TitleErr=$NameErr=$MobileErr=$validData=' ';
		$saver=0;
		$Pre=test_input($_POST["Title"]);
					if(empty($Pre))
					{
						$TitleErr="*Title Required!";
					}
					else $saver++;
		$Name=test_input($_POST["name"]);
					if(empty($Name))
					{
						$NameErr="*Name Required!";
					}
					elseif (!preg_match("/^[a-zA-Z ]*$/",$Name))
					{
						$NameErr="*Only Letters Allowed!";
						
					}
					else $saver++;
		$MobileNumber=test_input($_POST["MobileNumber"]);
					if(empty($MobileNumber))
					{
						$MobileErr="*Mobile Number Required!";
					}
					elseif (!preg_match("/^\d{10}$/", $MobileNumber))
					{
						$MobileErr="*Not Valid";
						
					}
					else $saver++;	
		$OrderDetails=test_input($_POST["OrderDetails"]);
					if(empty($OrderDetails))
					{
						$OrderDetailsErr="*Enter Details.";
					}
					else
					$saver++;
		$OrderType=test_input($_POST["OrderType"]);
					if(empty($OrderType))
						{
							$TypeErr="*Enter Order Type.";
						}
					else
						$saver++;
		$Priority=test_input($_POST["Priority"]);
					if(empty($Priority))
						{
							$PriorityErr="*Enter Priority.";
						}
					else
						$saver++;
		$comment=test_input($_POST["Comment"]);
					if(empty($comment))
					{
						$comment="NOT GIVEN";
					}
	if($saver==6)
	{
		
		$validData="readonly";
		$navigation="SaveOrder.php";
		$button="Save";
		$_SESSION["NEWORDER"]=uniqid();
	}
		
			
	}
?>

<html>
	<head>
	<script type="text/javascript">
		function select1()
		{
			var x=document.getElementById("TYPE");
			if (x.value=="My Shop")
			{
				var y= confirm(x.value);
				if (y== true)
				{
					document.location= "myshoporder.php";
				}
				else
					document.location="New_Order.php";
			}
			else
				alert(x.value);

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
</table>
<h1><font color="GREEN">-:New Order:-</font></h1>
<?PHP
	if($saver==6)
		{
			?><center><div bgcolor="white"><font color="yellow" size="6">Data Locked!</font></div></center><?PHP
		}
	?>
<form name='newOrder' method="POST" action="<?PHP if($saver==6){echo $navigation;}else{ htmlspecialchars($_Server['php_self']);}?>">
<table id="outer">
<tr>
	<td id="hilight"><b>Title:</b></td> 
	<td><select name="Title" size='1' id="TYPE" onchange="select1()">
		<option value="<?PHP echo $Pre; ?>"><?PHP echo $Pre; ?>
		<option value="Electrician">Electrician
		<option value="Customer">Customer
		<option value="My Shop">My Shop
		</select><span id="error"><?PHP echo $TitleErr; ?></span></td>
</tr>
<tr>
	<td id="hilight"><b>Name*:</b></td>
	<td id='hilight'><input name="name" type="text" size="35" maxlength="25" value="<?PHP echo $Name; ?>"<?PHP echo $validData; ?>><span id="error"><?PHP echo $NameErr;?></td>
</tr>
<tr>
	<td id="hilight"><b>Mobile Number*:</b></td>
	<td id="hilight"><input name="MobileNumber" type="text" size="15" maxlength="10" value="<?PHP echo $MobileNumber; ?>"<?PHP echo $validData; ?>><span id="error"><?PHP echo $MobileErr;?></td>
</tr>
<tr>
	<td id="hilight"><b>Order Details*:</b></td>
	<td id="hilight"><textarea rows="15" cols="27" name="OrderDetails" size="50" value="<?PHP echo $OrderDetails; ?>"<?PHP echo $validData; ?>><?PHP echo $OrderDetails; ?></textarea><span id="error"><?PHP echo $OrderDetailsErr; ?></td>
</tr>
<tr>
	<td><b>Order Type*:</b></td>
	<td><select name="OrderType" size="1">
		<option value="<?PHP echo $OrderType; ?>"> <?PHP echo $OrderType;?>
		<option value="Company"> Company
		<option value="Local"> Local
		<option value= "Both"> Both
		</select><span id="error"> <?PHP echo $TypeErr; ?></span></td>
</tr>		
<tr>
	<td id="hilight"><b>Priority*:</b></td>
	<td id="hilight"><select name="Priority" size="1">
					<option value="<?PHP echo $Priority; ?>"><?PHP echo $Priority; ?>
					<option value="High"> High
					<option value="Medium"> Medium
					<option value="Low"> Low
					</select><span id="error"><?PHP echo $PriorityErr; ?></span> </td>
</tr>

<tr>
			<td id="hilight"><b>Comment (if any):</b></td>
			<td><textarea name="Comment" cols="27"  value="<?php echo $comment?>"><?php echo $comment?></textarea></td>
			
</tr>
<tr>
	<td> &nbsp;</td>
	<td><input type="Submit" name="Submit" value="<?PHP echo $button;?>"></td>
</tr>
</table>
</form>
</html>