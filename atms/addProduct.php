<?php
include('./includes/header.php');
require('./database/dbconnect.php');
$refferedpage=$_GET['page'];
?>
<?php
$check= $_POST['Confirm'];
$ProductName= $_POST['Product'];
	if(isset($check))
	{
		if(!empty($ProductName))
			{
					$checkquery = "SELECT * from products where ProductName='$ProductName'";
					$checkdb= mysql_query($checkquery);
					$check= mysql_num_rows($checkdb);
					
				if($check==0)
					{
				
						?><center><progress align="center"><?php
						$Query1 = "INSERT INTO $db.`products` (`productID`, `ProductName`) VALUES (NULL, '$ProductName')" or die("Query Failed!". mysql_error());
						$insert = mysql_query($Query1);
						if($insert)
							{
								?><script type="text/javascript"> alert("Product <?php echo $ProductName; ?> Inserted.");</script><?php
							}
						?></progress></center><?php
					}
				else
					{
						?><script type="text/javascript"> alert("Given Product <?php echo $ProductName; ?> Already Exist.");</script><?php
					}
			}
		else
			{
			?><script type="text/javascript"> alert("Give a Product Name!");</script><?php
			}
			
	}
?>

<html>
<div align="right"><a href="./rpms/New_Replacement.php"><font color="yellow" size="4"> <---GO BACK---< </font></a></div>
<table width="50%">

<form name="AddProduct" align="center" method="POST" action="<?php $_SERVER['PHP_SELF']?>">
<tr>
	<td>Enter Product Name*:</td><td><input type="text" size="20" name="Product"/></td>
</tr>
<tr>
	<td> &nbsp;</td><td><input type="Submit" name="Confirm" value="Add Product"/></td>
</tr>
</form>
</html>
