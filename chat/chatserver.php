<?php 
if(isset($_POST['name']))       {
 $name=$_POST['name'];
$file=fopen("online.txt","a+") or die("Cannot open file");
$flag=0;
while(!feof($file))     {
        $line=fgets($file);
        if(preg_match("/^$name$/i",$line))  {
                $flag=1;
                break;
       }
}
if($flag=='0')  {
 flock($file,LOCK_EX);
 fwrite($file,"$name\n");
 fclose($file);

 $file=fopen("messages.txt","a") or die("Cannot open file");
 flock($file,LOCK_EX);
 fwrite($file,"<b>--- ''$name'' has logged in ---</b>\n");
 fclose($file);
 
 
 echo '<html>
<head>
<title>Chat Server</title>
<style type="text/css" >
.frameset {
margin:0;
padding:0;
}
.frameset frame{
margin:0;
padding:0;
}
</style>
</head>
<frameset cols="75%,25%" frameborder="no" framespacing="0" class="frameset">
	<frameset rows="75%,25%" frameborder="no" framespacing="0" class="frameset">
		<frame src="/chat/chatserverframemsgs.php?name='.$name.'"/>
		<frame src="/chat/chatserverframeenter.php?name='.$name.'" />
	</frameset>
	<frameset rows="0%,100%" frameborder="no" framespacing="0" class="frameset">
		<frame src="/chat/chatserverframedel.php" />
		<frame src="/chat/chatserverframeusers.php?name='.$name.'" />
	</frameset>
</frameset>
</html>
';
}
else    {
  fclose($file);
  header("Location: /chat/chatserverentry.php?msg=exist");
}
}
else {
  header("Location: /chat/chatserverentry.php?msg=login");
}
?>
