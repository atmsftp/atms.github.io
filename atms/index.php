<?php 
	//session_start();
	include('header.php');
	//if (isset($_SESSION['UserName']))
//	{
	function chatconfirm()
	{
		echo "<script type='text/javascript'> alert('You are going to different location! Please Confirm.');</script>";
		//header(Location:"192.168.1.120:7070/jappix");
	}
	?>
	
 <body>

 <center><a href="./index.php"><img height="250px" style="border: 0px;" width="200px" src="Images/AMT.png" alt="Amit Traders" name="Amit Traders"></img></a></center><p><br>
 <center><p><h3>Jump To:</h3><center>

 <table width="50%" height="" style="border: 2px solid blue;" bgcolor="#F0F88F">
	<tr>
		<td class="ex" border="0px"><div><a href="cms/cms.php"><center><img src="Images/Complaint.png" alt="Complaint Management System" name="CMS"></img></center></a></td></div>
		<td class="ex" border="0px"><div><a href="oms/oms.php"><center><img src="Images/Order.png" alt="Order Management System" name="OMS"></img></center></a></td></div></tr>
	<tr>	
		<td class="ex" border="0px"><div><a href="rms/rms.php"><center><img src="Images/Relationship.png" alt="Relationship Management System" name="RMS"></img></center></a></td></div>
		<td class="ex" border="0px"><div><a href="rpms/rpms.php"><center><img src="Images/Replacement.png" alt="Replacement Management System" name="RPMS"></img></center></a></td></div></tr>
 </table><br><br><br><br><br><br>
 <b>-: We Deal In:-</b>
 <table style=" height: 15px; border: 1px solid yellow;" bgcolor="white" height="15%">
	<tr>
		<td><img src="Images/DashBoard/1.jpg" border="0px" height="70px" width="80px"></td>
		<td><img src="Images/DashBoard/2.jpg"border="0px"height="70px" width="80px"></td>
		<td><img src="Images/DashBoard/3.jpg"height="70px"border="0px" width="80px"></td>
		<td><img src="Images/DashBoard/4.GIF"height="70px" border="0px"width="80px"></td>
		<td><img src="Images/DashBoard/5.jpg"height="70px" border="0px"width="80px"></td>
		<td><img src="Images/DashBoard/6.jpg"height="80px" border="0px"width="100px"></td>
		<td><img src="Images/DashBoard/7.jpg"height="80px" width="110px"border="0px"></td>
		<td><img src="Images/DashBoard/8.jpg"height="70px" width="100px"border="0px"></td>
	</tr>
 </table><p>

 <div style="align: bottom; height:3%;">
<footer><hr><address><center><b>Site Developed & Maintained by:</b> Er. Prashant Shukla (CCNA, RHCE and EMC Certified)<br>Best View in <b>Mozila Firefox 6.0</b> or Above. </center></address></hr></footer>
 </div>
 </html>
<?PHP
//}
//else
//echo "Incorrect Path or session Violated!"; 
?>
