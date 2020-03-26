<?php

  $file=fopen("online.txt","r") or die("Cannot open file");
  $file2=fopen("messages.txt","r") or die("Cannot open file");	
  $namearray=array();
  while(!feof($file))     {
  		$i=0;
		$flag=0;
        $line=fgets($file);
		$name=trim($line);
		while(!feof($file2))	{
			$line2=fgets($file2);
			if(preg_match("/\'\'$name\'\'/i",$line2))  {
               $flag=1;
		    }
			if($flag==1)	{
				if(preg_match("/^$name says/i",$line2))  {
					$i=0;
				}
				else	{
					$i++;
				}
			}	
	    }
//		echo $i."---".$name." <br> ";
		if($i>=20)	{
			array_push($namearray,$name);
		}
		fseek($file2,0);
  }
  
  fclose($file2);
  fclose($file);
  
  $file=fopen("online.txt","r") or die("Cannot open file");
  $str="";
  while(!feof($file))	{	
  	$flag=0;
  	$line=fgets($file);
	foreach($namearray as $row)	{
  		if(preg_match("/$row/i",$line))  {
			$flag=1;
		}
  	}
	if($flag!=1)	{
		$str.=$line	;
	}
  }
  fclose($file);
  
  $file=fopen("online.txt","w") or die("Cannot open file");
  flock($file,LOCK_EX);
  fwrite($file,$str);
  fclose($file);
  
  $file=fopen("messages.txt","a+") or die("Cannot open file");
  flock($file,LOCK_EX);
  foreach($namearray as $row)	{
  	fwrite($file,"<b>--- '$row' has logged out ---</b>\n");
  }
  fseek($file,0);
  while(!feof($file))     {
        $line=fgets($file);
		$str.=$line;
  }
  fclose($file);
  $newstr=$str;
  $file=fopen("messages.txt","w") or die("Cannot open file");
  flock($file,LOCK_EX);
  foreach($namearray as $row)	{
	  $newstr=preg_replace("/\'\'$row\'\'/","'$row'",$str);
  }
  fwrite($file,$newstr);
  fclose($file);
  
?>

<html>
<head>
<META HTTP-EQUIV="REFRESH" CONTENT="20; URL=/chat/chatserverframedel.php">
<title></title>
</head>
<body style="padding:0; margin:0;">
</body>
</html>