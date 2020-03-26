<?php
include('./includes/header.php');
require('./database/dbconnect.php');
$refferedpage=$_GET['page'];
echo $refferedpage;
?>
<?php
$check= $_POST['Confirm'];
$CompanyName= $_POST['Company'];
	if(isset($check))
	{
		if(!empty($CompanyName))
			{
					$checkquery = "SELECT * from company where Name='$CompanyName'";
					$checkdb= mysql_query($checkquery);
					$check= mysql_num_rows($checkdb);
					
				if($check==0)
					{
				
						?><center><progress align="center"><?php
						$Query1 = "INSERT INTO $db.`company` (`companyID`, `Name`) VALUES (NULL, '$CompanyName')"; 
						$insert = mysql_query($Query1) or die("Query Failed!". mysql_error());
						if($insert)
							{
								?><script type="text/javascript"> alert("Company <?php echo $CompanyName; ?> Inserted.");</script></center><?php
								
							}
						?><?php
					}
				else
					{
						?><script type="text/javascript"> alert("Given Company <?php echo $CompanyName; ?> Already Exist.");</script><?php
					}
			}
		else
			{
			?><script type="text/javascript"> alert("Give a company Name!");</script><?php
			}
			
	}
?>

<html>
<div align="right"><a href="./rpms/New_Replacement.php"><font color="yellow" size="4"> <---GO BACK---< </font></a></div>
<table width="50%">

<form name="AddCompany" align="center" method="POST" action="<?php $_SERVER['PHP_SELF']?>">
<tr>
	<td>Enter Company Name*:</td><td><input type="text" size="20" name="Company"/></td>
</tr>
<tr>
	<td> &nbsp;</td><td><input type="Submit" name="Confirm" value="Add Company"/></td>
</tr>
</form>
</html>
