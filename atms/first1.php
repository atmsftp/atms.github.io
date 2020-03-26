<?PHP
session_start();
include ("C:/xampp/htdocs/ATMS/DTA/header.php");
require("C:/xampp/htdocs/ATMS/DTA/dbconnect.php");
function test_input($data)
				{
					$data=trim($data);
					$data=stripslashes($data);
					$data=htmlspecialchars($data);
					return $data;
				}
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$Username=test_input($_POST['username']);
		if(empty($Username))
		{
			$userErr="Enter User Name";
		}
		else
		{
			$Password=test_input($_POST['password']);
			if(empty($Password))
				$passErr="Enter Password";
			else
			{
				$sql="SELECT Password from userinfo where UserName= '$Username'";
				$query=mysql_query($sql) or die("Database Error" . mysql_error());
				$count= mysql_num_rows($query);
				if($count<1)
				{
					echo "<script type='text/javascript'>alert('Incorrect Username or Password');</script>";
				}
				else
				{
					$data=mysql_fetch_array($query);
					if($data['Password']==$Password)
					{
						
						$_SESSION['UserName']=uniqid();
						require("index.php");
						exit();
					
					}
					else
					echo "<script type='text/javascript'>alert('Incorrect Username or Password');</script>";
				}
				
			
			
			}
		}
	}
?>
<html>
<center><a href="first.php" alt="Amit Traders Logo"><img height="100px" width="800px" src="Images/ATMSMAIN.png"><a/></center>

<center>
<div align="center" class="background"><br><br>
<div align="center" class="transbox">

<p>
<font size="4">-:LOGIN:-</font>
<form name="loginform" action="<?PHP $_SERVER['PHP_SELF']?>" method="post">
    <table border="0" align="center" cellpadding="2" cellspacing="5">
    <tr>
		<td ><div align="right"><b>User Name</b></div></td>
		<td ><input name="username" type="text" maxlength="10"><span id="error"><?PHP echo $userErr;?></span></td>
	</tr>
    <tr>
		<td><div align="right"><b>Password</b></div></td>
		<td><input name="password" type="password" maxlength="8"><span id="error"><?PHP echo $passErr;?></span></td>
    </tr>
    <tr>
		<td><div align="right"></div></td>
		<td><input name="" type="submit" value="login" /></td>
    </tr>
    </table>
</form></p></div></div>
<br><br>
 <b>-: We Deals In:-</b>
 <table style="border: 1px solid yellow;" bgcolor="white" height="15%">
	<tr>
		<td><img src="Images/DashBoard/1.jpg"height="70px" width="80px"></td>
		<td><img src="Images/DashBoard/2.jpg"height="70px" width="80px"></td>
		<td><img src="Images/DashBoard/3.jpg"height="70px" width="80px"></td>
		<td><img src="Images/DashBoard/4.gif"height="70px" width="80px"></td>
		<td><img src="Images/DashBoard/5.jpg"height="70px" width="80px"></td>
		<td><img src="Images/DashBoard/6.jpg"height="80px" width="100px"></td>
		<td><img src="Images/DashBoard/7.jpg"height="80px" width="110px"></td>
		<td><img src="Images/DashBoard/8.jpg"height="70px" width="100px"></td>
	</tr>
 </table>
 <div style="align: bottom; height:3%;">
<footer><hr><address><center><b>Site Developed & Maintained by:</b> Er. Prashant Shukla (CCNA, RHCE and EMC Certified)<br>Best View in <b>Mozila Firefox 6.0</b> or Above. </center></address></hr></footer>
 </div></center>
 </html> 