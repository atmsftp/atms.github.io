<?php
include ("../../includes/header.php");
require("../../database/dbconnect.php");
?>	
<html>
<head>
<style type="text/css">
body
{
margin: 0;
padding: 0;
text-align:center;
}
.top-bar
{
width: 100%;
height: auto;
text-align: center;
background-color:#FFF;
border-bottom: 1px solid #000;
margin-bottom: 20px;
}
.inside-top-bar
{
margin-top: 4px;
margin-bottom: 5px;
background-color:#F0F88F;
}
.link
{
font-size: 18px;
text-decoration: none;
background-color: #000;
color: #FFF;
padding: 5px;
}
.link:hover
{
background-color: #FCF3F3;
}
</style>

</head>
<body>

<div class="top-bar">
<table bgcolor="#F0F88F">
<div class="inside-top-bar"><b><h1>Import Pendency CSV to Server!</h1></b><br><br>
</div></table>
</div>
<div style="text-align:left; border:1px solid #333344; width:300px; margin:0 auto; padding:10px;">

<form name="import" method="post" enctype="multipart/form-data">
<tr>
	<td>
<?PHP $month= date('F', strtotime(date('Y-m')." -1 month"));?>
<b>Pendency Month: </b><select name="month" size="1">
												<option value="<?php echo $month?>"><?PHP echo $month?>
												<option value="Jan">January
												<option value="Feb">February
												<option value="Mar">March
												<option value="Apr">April
												<option value="May">May
												<option value="Jun">June
												<option value="Jul">July
												<option value="Aug">August
												<option value="Sep">September
												<option value="Oct">October
												<option value="Nov">November
												<option value="Dec">December
												</select>
<?PHP $Year= date('Y');?>												
					<select name="year" size="1">
					<option value="<?PHP echo $Year?>"> <?php echo $Year?>
					
	</td>
</tr>
<tr>
	<td>
		<br><br><br><input type="file" name="file" /><br />
		<input type="submit" name="submit" value="Submit" />
	</td>
</tr>

</form>



<?php
/* Form Ends Here and POST Operation starts from Here!!*/
if(isset($_POST["submit"]))
{
$file = $_FILES['file']['tmp_name'];

/*Preparing For PendencyRecord*/

$month=$_POST["month"];
$Year=$_POST["year"];
$monthYear= "$month$Year";

$ext = pathinfo($file, PATHINFO_EXTENSION);
/*$chk_ext = explode(".", $file);
if(strtolower(end($chk_ext)) == "csv")*/

if($ext!="csv")	
{
$handle = fopen($file, "r");
$c = 0;
mysql_query("Delete from pendencybuffer");
while(($filesop = fgetcsv($handle, 1000, ",")) !== FALSE)
	{
		$name = $filesop[0];
		$Mob = $filesop[1];
		$Amount= $filesop[2];
		$sql = mysql_query("INSERT INTO pendencybuffer (Name, Number, Amount) VALUES ('$name','$Mob','$Amount')");
		
	}
		fclose($handle);
	if($sql)
	{
		mysql_query("delete from pendencybuffer where Amount=0.00");
		$data= mysql_query("select * from pendencybuffer");
		$c= mysql_num_rows($data);
		
		echo "<font color='#F0F8FF'>Your database has imported successfully! You have inserted <font color='yellow'><b>". $c ."</b></font> records.</font>";
	
	
	/*If Data Uploaded to BUFFER Successfully then we will Analyse data to save on PendencyRecord Table*/
	
	$result = mysql_query('SELECT SUM(Amount) AS value_sum FROM pendencybuffer'); 
	$row = mysql_fetch_assoc($result); 
	$sum = $row['value_sum'];
	
	
	$sql1=mysql_query("select pid From pendencyrecord where monthYear='$monthYear'");
	$result=mysql_fetch_assoc($sql1);
	$pid=$result['pid'];
	$check= mysql_num_rows($sql1);
	echo $check;
	IF($check>0)
	{
		echo "Month:$monthYear, TNP: $c, Amount: $sum, pid: $pid";
		mysql_query("Update pendencyrecord SET TNP= $c, TAmount=$sum where pid = $pid");
	}
	
	else
	{
		echo "Month:$monthYear, TNP: $c, Amount: $sum";
		
		mysql_query("INSERT INTO pendencyrecord VALUES ('','$monthYear','$c','$sum')");
	}
	
	}
	else
	{
		echo "Sorry! There is some problem.";
	}
}
	else 
		echo "<font color='red'>Sorry! File type is not CSV.</font>";
		/*
	{?>
	<script type="text/javascript">alert("File Type is NOT csv!!");</script>
	<?php}*/
}?>
</div>
</body>
</html>