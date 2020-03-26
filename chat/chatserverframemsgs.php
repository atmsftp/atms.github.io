<?php 
  if(isset($_GET['name'])) {
 $name=$_GET['name'];
 $file=fopen("messages.txt","a+") or die("Cannot open file");
 $str="";
 $flag=0;
 while(!feof($file))     {
        $line=fgets($file);
        if(preg_match("/\'\'$name\'\'/i",$line))  {
        $flag=1;
		}
		if($flag==1) {
			if(!preg_match("/\'.+?\'/i",$line))	{
				$r=rand(00,99); $g=rand(00,99); $b=rand(00,99);
        		$str.="<font color='#$r$g$b' face='Verdana, Arial, Helvetica, sans-serif' size='-2' style='font-weight:bold'><b>".$line."</b></font><br>";
			}
			else	{
        		$str.="<font color='#CC0000' face='Verdana, Arial, Helvetica, sans-serif' size='-2' style='font-weight:bold'>".$line."</font><br>";			
			}
		}
   }
  fclose($file);
}
?>
<html>
<head>
<title></title>
<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=/chat/chatserverframemsgs.php?name=<?php echo $name; ?>">
<script type="text/javascript">
    function scrollToBottom()
	{
		var elm = document.getElementById("msgswindow");
		document.body.scrollTop = elm.scrollHeight;
	}
</script>
</head>
<body style="padding:0; margin:0;" onLoad="scrollToBottom();">
<div id="msgswindow">
<table><tr><td>
<?php echo $str; ?>
</td></tr></table>
</div>
</body>
</html>