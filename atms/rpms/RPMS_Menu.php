<?PHP
include('../database/dbconnect.php');
$sql="select RRN from replacement_status where STATUS='Pending'";
$query=mysql_query($sql);
if(mysql_num_rows($query)>0)
$notification= mysql_num_rows($query);
else
$notification="";
?>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="../style.css"></link>
 </head>
 <body>
<table align='center' height="15px" bgcolor="#F0F8FF" style="border:1px solid black;border-collapse: collapse;">
	<tr>
		<td id="ex"><a href="./New_Replacement.php"><img src="../Images/New.png" height="35px" alt="New"></img></td></a>
		<td id="ex"><a href="./Search_Replacement.php"><img src="../Images/Search.png" height="35px" alt="New"></img></td></a>
		<td id="ex" width="10%"><a href="./ADMIN/Admin_replacement.php"><img src="../Images/ADMIN.png" height="35px" alt="Administrate"></a><span id="error"><?PHP echo "<font size='4'>($notification)</font>";?></span> </img></td>
		<td id="ex" width="10%"><a href="./Print_Replacement.php"><img src="../Images/Print_Slip.png" height="35px" alt="Print Receipt"></img></a></td>
		
	</tr>
</table>
</body>
</html>