<?PHP
session_start();
include ("../../includes/header.php");
require("../../database/dbconnect.php");
$auth=$_POST['UniqueID'];
$_SESSION['UniqueID']=$auth;
	if(!empty($auth))
	{
		$userName=$_POST["UserName"];
		$password=$_POST["Password"];
		$sql="SELECT Password from userinfo where UserName='$userName'";
		$query=mysql_query($sql);
		$count= mysql_num_rows($query);
		if($count>0)
		{
			$data=mysql_fetch_array($query);
				if($password==$data['Password'])
				{				
						require("solveReplacement.php");
				}
				else
				{
				Echo "<font color='RED' size='5'>Password Incorrect!</font><br><a href='Admin_replacement.php'><<<<<BACK<<<<<</a>";
				unset($_SESSION['Session_ID']);
				}
		}
		else
		{
				Echo "<font color='RED' size='5'>UserName is Incorrect!</font><br><a href='Admin_replacement.php'><b>ReLogin</b></a>";
				unset($_SESSION['Session_ID']);
		}
		
	}	
	else
	{
		Echo "<font color='red'>Session not found. </font><br><a href='Admin_replacement.php'><b>ReLogin</b></a>";
		unset($_SESSION['Session_ID']);
		session_destroy();
	}
?>