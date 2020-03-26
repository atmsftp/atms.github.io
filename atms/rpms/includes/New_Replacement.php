<?PHP 
	session_start();
	error_reporting(0);
	$_SESSION['NewEntry']= uniqid();
	include('../includes/header.php'); 
	require ('../database/dbconnect.php');
									//FORM VALIDATION STARTS HERE//
	
	$firstname=$lastname=$mobilenumber=$address=$company=$product=$day=$month=$year=$quantity=$productdetail=$problem=$priority=$comment=$submit=$select1=" ";
	$saver=0;
	?>
	
	<head>
	<script type="text/javascript">
		function select2()
		{
			var x=document.getElementById("product");
			alert(x.value);
	

		}
		function select1()
		{
			var x=document.getElementById("company");
			alert(x.value);
	

		}
	</script>
	</head>
	<?PHP
	echo $select1;
	function test_input($data)
				{
					$data=trim($data);
					$data=stripslashes($data);
					$data=htmlspecialchars($data);
					return $data;
				}
				
	
	    	if($_SERVER["REQUEST_METHOD"]=="POST")
			{
			$firstname=test_input($_POST["F_name"]);
					if(empty($firstname))
					{
						$nameErr="*Name Required!";
					}
					elseif (!preg_match("/^[a-zA-Z]*$/",$firstname))
					{
						$nameErr="*Only Letters Allowed!";
						
					}
					else $saver++;	
			$lastname=test_input($_POST["L_name"]);
					if(empty($lastname))
					{
						$saver++;
					}
					elseif (!preg_match("/^[a-zA-Z]*$/",$lastname))
						{
							$lnameErr="*Only Letters Allowed!";
						
						}
					else $saver++;
			$mobilenumber=test_input($_POST["Mob_Num"]);
					if(empty($mobilenumber))
					{
						$mobilenumberErr="*Mobile Number Required!";
					}
					elseif (!preg_match("/^\d{10}$/", $mobilenumber))
					{
						$mobilenumberErr="*Not Valid";
						
					}
					else $saver++;
			$address=test_input($_POST["Address"]);
					if(empty($address))
					{
						$addressErr="*Address Required!";
					}
					else $saver++;
			$company=test_input($_POST["Company_Name"]);
					if(empty($company))
					{
						$companyErr="*Company Required!";
					}
					else $saver++;
			$product=test_input($_POST["Product_Name"]);
					if(empty($product))
					{
						$productErr="*Product Required!";
					}
					else $saver++;
			$day=test_input($_POST["day"]);
				if(empty($day))
					{
						$dayErr="*Day Required!";
					}
				else $saver++;
			$month=test_input($_POST["month"]);
					if(empty($month))
					{
						$monthErr="*Month Required!";
					}
					else $saver++;
			$year=test_input($_POST["year"]);
					if(empty($year))
					{
						$yearErr="*Year Required!";
					}
					else $saver++;
			$quantity=test_input($_POST["quantity"]);
					if(empty($quantity))
					{
						$quantityErr="Quantity Required!";
					}
					else $saver++;
			$productdetail=test_input($_POST["P_Detail"]);
					if(empty($productdetail))
					{
						$productdetailErr="*Detail Required!";
					}
					else $saver++;
			$problem=test_input($_POST["Problem"]);
					if(empty($problem))
					{
						$problemErr="Problem Required!";
					}
					else $saver++;
			$priority=test_input($_POST["Priority"]);
					if(empty($priority))
					{
						$priorityErr="*Priority Required!";
					}
					else $saver++;
			$comment=test_input($_POST["Comment"]);
				if(empty($comment))
				$comment="NOT GIVEN";
			
			
			}
		////Checked Everything is SuccessFull./////
		if($saver==13)
			{
				$navigation="SaveReplacement.php";
				$validData="readonly";
				
			}
	
?>
<table align="center">
	<tr>
		<td>
			<div style="height: 30px;">
				<?PHP include('RPMS_Menu.php');?>
			</div>
		</td>
	</tr>
</table>

<?PHP 
	if($saver==13)
	{
?>
		<table width="100%" height="2%">
			<tr>
				<td bgcolor="white"><font color="BLUE" size="5"><center>Data LOCKED and can not modify here.</center></font></td>
			</tr>
		</table>
<?PHP
	}
	else
	{
?>
	<table width="100%" height="2%">
		<tr>
			<td style="textalign: left"><font color="RED" size='6'>Attention!</font><font color="Yellow" size='4'> Please check required <font color="BLUE">Company</font> and <font color="BLUE">Product</font> are available below or NOT?</font></td>
			<td><a href="New_Replacement.php"><font color="Yellow" size="6">Refresh</font></a></td>
		</tr>
	</table>
<?PHP 
	} 
?>
		
<font size="6">-:New Entry:-</font><br>

								<?PHP /////////////////////////////FORM ENTRY////////////////////////////?>

<table id="outer">
	<form name="New_Entry" action="<?php if($saver==13){ echo $navigation;} else { echo htmlspecialchars($_Server['php_self']);}?>" method="POST">
	<tr>
		<td id="hilight">First Name*:</td>
		<td><input type="text" style="border-style: groove;"<?php echo $validData; ?> name="F_name" size="25" value="<?php echo $firstname?>" maxlength="25"/><span id="error"><?php echo $nameErr?></span></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td id="hilight">Last Name:</td>
		<td><input type="text" name="L_name" size="25" value="<?php echo $lastname?>"maxlength="25"<?php echo $validData; ?>/><span id="error"><?php echo $lnameErr?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td id="hilight">Mobile Number*:</td>
		<td><input type="text" <?php echo $validData; ?> name="Mob_Num" size="25" maxlength="10" value="<?php echo $mobilenumber?>"/><span id="error"><?php echo $mobilenumberErr?></span></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td id="hilight">Address*:</td>
		<td><textarea name="Address" <?php echo $validData; ?> value="<?php echo $address?>"size="15"><?php echo $address?></textarea><span id="error"><?php echo $addressErr?></span></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
	<?php
		if($saver==13)
		{
		 ?>
		<td id="hilight">Company*:</td>
		<td><input type="hidden" name="Company_Name" size="15" value="<?php echo $company?>"<?PHP echo $validData; ?>>	<?php echo $company?> </input></td>
		<td>Product*:</td>
		<td><input type="hidden" name="Product_Name" size="10" value="<?php echo $product?>"> <?php echo $product ?></input></td>
		<?PHP
		}
		else
		{
		
		$query="SELECT DISTINCT Name From company" or die("Query Failed" . mysql_error());
		$result= mysql_query($query);?>
		<td id="hilight">Company*:</td>
		<td><select name="Company_Name" id="company" size="1" onchange="select1()"><option value="<?php echo $company?>"><?php echo $company?>
							<?php while($data=mysql_fetch_array($result))
							{
								$displayCompany= $data['Name'];
							?>
							<option value="<?php echo $displayCompany;?>"<?php echo $disable;?>><?php echo $displayCompany;?>
								
							<?php }?></option></select><span id="error"><?php echo $companyErr?></span>
							<a href="../addCompany.php"><font color="BLUE">New Company</font></a>
		</td>
							
		<?php
		$query="SELECT DISTINCT ProductName From products" or die("Query Failed" . mysql_error());
		$result= mysql_query($query);?>
		<td id="hilight">Product*:</td>
		<td><select name="Product_Name"  id="product" size="1" onchange="select2()"><option value="<?php echo $product?>"><?php echo $product ?>
							<?php while($data=mysql_fetch_array($result))
							{
								$displayCompany= $data['ProductName'];
							?>
							<option value=<?php echo $displayCompany;?>><?php echo $displayCompany;?>
								
							<?php }?></option></select><span id="error"><?php echo $productErr?></span>
						<a href="../addProduct.php"><font color="BLUE">New Product</font></a>
		</td>
		<?PHP 
		}
		?>
	</tr>
	<tr>
	<?PHP
		if($saver==13)
		{
	?>
		<td id="hilight">Warranty Date Mentioned* (DD/MM/YYYY):</td>
		<td><input type="hidden" name="date" value="<?PHP echo $day;?>/<?PHP echo $month;?>/<?PHP echo $year;?>"> <?PHP echo $day;?>/<?PHP echo $month;?>/<?PHP echo $year;?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<?PHP
		}
		else
		{
	?>
		<td id="hilight">Warranty Date Mentioned*:</td>
		<td><select name="day" size="1">DAY:
												<option value="<?php echo $day?>"><?PHP echo $day?>
												<?php
														for ($j=01 ; $j<=31; $j++)
															{
																echo "<option value=$j>$j";
															}?>
															</select>	<span id="error"><?php echo $dayErr?></span>
		<select name="month" size="1">
												<option value="<?php echo $month?>"><?PHP echo $month?>
												<option value="01">January
												<option value="02">February
												<option value="03">March
												<option value="04">April
												<option value="05">May
												<option value="06">June
												<option value="07">July
												<option value="08">August
												<option value="09">September
												<option value="10">October
												<option value="11">November
												<option value="12">December
												</select><span id="error"><?php echo $monthErr?></span>
		<select size=1 name="year">
			<option value="<?php echo $year?>"><?PHP echo $year?>
			<?php
				$currentyear= date("Y");
				for($k=$currentyear; $k>=$currentyear-6; $k--)
				{
					echo "<option value=$k>$k";
				}
			?></select><span id="error"><?php echo $yearErr?></span>
			
		</td>
		<td> &nbsp;</td>
		<td> &nbsp;</td>
	<?PHP
		}
	?>
	</tr>
	<tr>
	<?PHP
		if($saver==13)
		{
									
	?>
		
		<td id="hilight">Quantity*:</td>
		<td><input type="hidden" name="quantity" <?PHP echo $validData;?> value="<?PHP echo $quantity;?>"><?PHP echo $quantity;?></td>
		<td> &nbsp;</td>
		<td> &nbsp;</td>
	<?PHP
		}
		else
		{
	?>
			<td id="hilight">Quantity*:</td>
			<td><select name="quantity"  size="1">
			<option value="<?php echo $quantity?>"><?PHP echo $quantity?>
			<?php
			for ($i=1 ; $i<=10 ; $i++){
			echo "<option value=$i>$i";
			}?>				
			</select><span id="error"><?php echo $quantityErr?></span> </td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
	<?PHP
		}
	?>
	</tr>
		
	<tr>
			<td id="hilight">Product Detail:</td>
			<td> <textarea name="P_Detail" value="<?php echo $productdetail?>"size="15"<?php echo $validData; ?>><?php echo $productdetail?></textarea><span id="error"><?php echo $productdetailErr?></span></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
	</tr>
	
	<tr>
			<td id="hilight">Problem:</td>
			<td> <textarea name="Problem" value=<?php echo $problem?>  size="15"<?php echo $validData; ?>><?php echo $problem?></textarea><span id="error"><?php echo $problemErr?></span></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
	</tr>
	
	
	<tr>
	<?PHP
		if($saver==13)
		{
	?>
			<td id="hilight">Priority*</td>
			<td><input type="hidden" name="Priority" value="<?PHP echo $priority;?>"> <?PHP echo $priority;?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
	<?php
		}
	else 
		{
	?>
			<td id="hilight">Priority*:</td>
			<td><select name="Priority" size="1"><option value="<?php echo $priority?>"<?php echo $validData; ?>><?PHP echo $priority?><option value="High"><font color="RED">High</font><option value="Medium"><font color="Yellow">Medium</font><option value="Low"><font color="Green">Low</font></select><span id="error"><?php echo $priorityErr?></span></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
	<?PHP
		}
	?>
	</tr>
	<tr>
			<td id="hilight">Comment (if any):</td>
			<td><textarea name="Comment" size="30" value="<?php echo $comment?>"<?php echo $validData; ?>><?php echo $comment?></textarea></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
	</tr>
	<?PHP 
	if($saver!= 13)
	{
	?>
	<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="Submit" name="Submit" value="Submit Query"></td>
			<td>&nbsp;</td>		
	</tr>
	<?PHP
	}
	else
	{ 
					
	?>
	<tr>
			<td><input type="hidden" name="NewEntry" value="<?PHP echo $_SESSION['NewEntry']; ?>"></td>
			<td><input type="Submit" name="save" value="Save"/></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		
	</tr>	
	
	<?php
	} 
	?>
 
 </form>
</table>	
</html>