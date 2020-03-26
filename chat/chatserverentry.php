<?php
$welcome="<font color='green' size='4'><b><center>Lisp Chat Facility</b></center></font><br>Put up a name to enter chat : ";
if(isset($_GET['msg'])) {
$msg=$_GET['msg'];
if($msg=='exist')  {
  $welcome="User with same name already logged in.<br><br> Enter another name : ";
}
else if($msg=='success')  {
 $welcome="Logged off successfully.<br><br>Put up a name to log back in : ";
}
else if($msg=='login') {
 $welcome="Log in here to use chat.<br><br>Put up a name to enter chat : ";
}
else {
 $welcome="Put up a name to enter chat : ";
}
}
?>

<html>
<head>
<script language="Javascript" type="text/javascript">
function check_name()	{
	var inputch=/^(\w|\d)+$/;
	if(document.nameform.name.value=="")	{
		alert("Enter a name first");
		document.nameform.name.focus();
		return false;
	}
	if(!document.nameform.name.value.match(inputch))        {
        	alert("Entered name cannot contain special chacarters and spaces");
	        document.nameform.name.focus();
        	return false;
        }
	return true;
}

</script>
<style type="text/css">
.body	{
	margin:0;
	padding:0;
	background-color:BBFFBB;
}
#welcomemsg {
	color:#333333;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;
	font-weight:bolder;
	margin-left:20px;
}
#basemessage	{
	color:#333333;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:10px;
	font-weight:bolder;
	margin-left:155px;
}
#entername	{
	margin-left:100px;	
}
#loginbutton	{
	margin-left:190px;
	width:100px;
	height:30px;
}
</style>
<title>Chat Application</title>
</head>

<body class="body"><br>
<font id="welcomemsg" > <?php echo $welcome; ?> </font>
<br><br><br>
<form name="nameform" action="/chat/chatserver.php" method="POST" onSubmit="return check_name();"> 
<input type="text" name="name" value="" id="entername" size="40"/>
<br>
<input type="submit" name="enter" value="Log In" id="loginbutton">
</form>
</body>
<br><br><br><br>
<font id="basemessage">(Watch the changing colours)</font>
</html>