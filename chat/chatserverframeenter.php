<?php 
if(isset($_GET['name'])) {
$name=$_GET['name'];
}
else {
  echo '<script language="Javascript" type="text/javascript">
    function logout() {
	window.parent.location.href="/chat/chatserverentry.php?msg=login";
	}
   logout();</script>';
}

if(isset($_POST['message'])) {
$msg=$_POST['message'];
$file=fopen("messages.txt","a") or die("Cannot open file");
flock($file,LOCK_EX);
fwrite($file,"$name says : $msg \n");
fclose($file);
}
?>
<html>
<head><title></title>
<script language="javascript" type="text/javascript">
function submitform(evnt) {
	var keycode;
	if(evnt) {
		keycode=evnt.which;
	}
	if(keycode==13) {
		 if(chkform())	{
		 	document.msgform.submit();
		 	return false();
		 }
		 else {
		 	document.msgform.message.focus();
			return false;
		 }
	}
	else {
			return true;
	}
}
function focusfn() {
	document.msgform.message.focus();
}
function chkform()	{
	var inputre=/(\'|\<|\>|\")/;
	var inputwords=/(f.{0,3}u.{0,3}c.{0,3}k)/;
        if(document.msgform.message.value=="") {
        	alert("Enter some text");
        	return false;
        }
		if(document.msgform.message.value.match(inputre))        {
                        alert("Entered name cannot contain \' \" \< \> ");
                        return false;
        }
		if(document.msgform.message.value.match(inputwords))        {
                        alert("Watch your language");
                        return false;
        }
		
        return true;
}
</script>

</head>
<body style="padding:0; margin:0;" onLoad="focusfn();">
<form name="msgform" action="/chat/chatserverframeenter.php?name=<?php echo $name; ?>" method="POST" onSubmit="return chkform();">
<table  cellpadding="0" cellspacing="0" style="padding:0; margin:0;"><tr valign="bottom"><td>
<textarea name="message" cols="36" rows="3" onKeyPress="return submitform(event);"></textarea>
</td><td>
<input name="addmsg" type="submit" value="Enter" style="height:55px; width:60px;" />
</td></tr></table>
</form>
</body>
</html>