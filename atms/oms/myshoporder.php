<?PHP
session_start();
if(isset($_SESSION['NEWORDER']))
{
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
	$allclear=' ';
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$saver=0;
				
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
		if($saver==3)
		{
		
			$validData="readonly";
			$navigation="SaveShopOrder.php";
			$button="Save";
			$allclear="Data Locked!";
		}
	}
	?>
<table align="center">
	<tr>
		<td>
			<div style="height: 30px;">
				<?PHP include('OMS_Menu.php');?>
			</div>
		</td>
	</tr>
</table>
<h1><font color="GREEN">-:My Shop Order:-</font></h1>
<table align="center">
	<tr bgcolor="white">
		<td align="center" ><font color="GREEN" size="4"><?PHP echo $allclear; ?></font></td>
	</tr>
</table>
<form name='newOrder' method="POST" action="<?PHP if($saver==3){echo $navigation;}else{ htmlspecialchars($_Server['php_self']);}?>">
<table id="outer">
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
</tr></table></form></html>
<?PHP
}
else
echo "Wrong Entry";
?>