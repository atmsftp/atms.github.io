<?PHP
include('../database/dbconnect.php');
$sql="select * from order_status where STATUS='Pending'";
$sql1="select * from shoporder_status where STATUS='Pending'";
$query=mysql_query($sql);
$query1=mysql_query($sql1);
?>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="../style.css"></link>
 </head>
 <body>
<table align='center' height="15px" bgcolor="#F0F8FF" style="border:1px solid black;border-collapse: collapse;">
	<tr>
		<td id="ex"><a href="./New_Order.php"><img src="../Images/New.png" height="35px" alt="New"></img></td></a>
		<td id="ex"><a href="./Search_Order.php"><img src="../Images/Search.png" height="35px" alt="New"></img></td></a>
		<td id="ex" width="10%"><a href="./ADMIN/Admin_Order.php"><img src="../Images/ADMIN.png" height="35px" alt="Administrate"></a><span id="error"><?PHP echo "<font size='4'> (".mysql_num_rows($query)."+".mysql_num_rows($query1).")</font>";?></span> </img></td>
		<td id="ex" width="10%"><a href="./Print_Order.php"><img src="../Images/Print_Slip.png" height="35px" alt="Print Receipt"></img></a></td>
		
	</tr>
</table>
</body>
</html>