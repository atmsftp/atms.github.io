<?php 
if(isset($_GET['name'])) {
 $name=$_GET['name'];
 $file=fopen("online.txt","r") or die("Cannot open file");
 $flag=0;
 while(!feof($file))     {
        $line=fgets($file);
        if(preg_match("/^$name$/i",$line))  {
                $flag=1;
                break;
       }
}
if(!$flag=='1')  {
  fclose($file);
  echo '<script language="Javascript" type="text/javascript">
    function logout() {
	window.parent.location.href="/chat/chatserverentry.php?msg=login";
	}
   logout();</script>';
}
fclose($file);
}
else {
  echo '<script language="Javascript" type="text/javascript">
    function logout() {
	window.parent.location.href="/chat/chatserverentry.php";
	}
   logout();</script>';
}

if(isset($_POST['discon']))  {
  $name=$_GET['name'];
  $file=fopen("online.txt","r") or die("Cannot open file");
  $str="";
  while(!feof($file))     {
        $line=fgets($file);
        if(!preg_match("/^$name$/i",$line))  {
            $str.=$line;   
       }
  }
  fclose($file);
  $file=fopen("online.txt","w") or die("Cannot open file");
  flock($file,LOCK_EX);
  fwrite($file,$str);
  fclose($file);
  
  $file=fopen("messages.txt","a+") or die("Cannot open file");
  flock($file,LOCK_EX);
  fwrite($file,"<font color='#EE0000' face='Verdana, Arial, Helvetica, sans-serif' size='-2'><b>--- '$name' has logged out ---</b></font>\n");
  fseek($file,0);
  while(!feof($file))     {
        $line=fgets($file);
		$str.=$line;
  }
  fclose($file);
  $file=fopen("messages.txt","w") or die("Cannot open file");
  flock($file,LOCK_EX);
  $newstr=preg_replace("/\'\'$name\'\'/","'$name'",$str);
  fwrite($file,$newstr);
  fclose($file);
  
  echo '<script language="Javascript" type="text/javascript">
    function logout() {
	window.parent.location.href="/chat/chatserverentry.php?msg=success";
	}
   logout();</script>';
}


?>
<html>
<head>
<META HTTP-EQUIV="REFRESH" CONTENT="10; URL=/chat/chatserverframeusers.php?name=<?php echo $name; ?>">
<title></title>
</head>
<body style="padding:0; margin:0;">
<form action="/chat/chatserverframeusers.php?name=<?php echo $name; ?>" method="POST">
<table cellpadding="0" cellspacing="0" style="padding:0; margin:0;"><tr><td>
<textarea name="usersonline" cols="14" rows="16" wrap="off" style="font-weight:bold; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; color:BB1111;">
<?php 
$file=fopen("online.txt","r");
while(!feof($file))	{
$line=fgets($file);
echo $line;
}
?>
</textarea>
</td></tr><tr><td align="center">
<input type="submit" name="discon" value="Log Out" style="height:29px; width:120px;">
</td></tr>
</form>
</body>
</html>