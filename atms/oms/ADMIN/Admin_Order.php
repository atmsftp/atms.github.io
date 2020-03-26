<?PHP
session_start();
include ("../../includes/header.php");
require ('../../database/dbconnect.php');
			$_Session['Session_ID']= uniqid();
			
			
?>

<html>
<center><font color="#0FF345" size="5"><b>-:Administration:-</b></font></center>
				
<form method="POST" action="LoginVerify.php">
<table align="center" bgcolor="#F0F88F">
	<tr>
		<td><b>User Name:</b></td><td><input type="text" maxlength="10" Name="UserName" size="25"></td>
	</tr>
	<tr>
		<td><b>Password:</b></td><td><input type="password" name="Password" maxlength="8" size="25"></td>
	</tr>
	<tr>
		<td><b>Location:</b></td><td><select size="1" name="Location">
									<option value="People">People
									<option value="My Shop">My Shop</option></td>
	</tr>
	<tr>
		<td><input type="hidden" name="UniqueID" value="<?PHP echo $_Session['Session_ID'];?>"></td><td>&nbsp;</td>
		<center><td><input type="Submit" value="LogIn" size="8"></td><td>&nbsp;</td></center>
	</tr>
</table>
</form></html>