<script>

function getEmail(emailid)
{
	email  = new XMLHttpRequest();
	email.open('GET' , 'test.php?email='+emailid, true);
	email.send();
	email.onreadystatechange = function()
	{
		if (email.readyState == 4 && email.status == 200)
		{
			document.getElementById('emailDiv').innerHTML = email.responseText;
		}
	}
}
function password()
{
	var a =	document.getElementById('pass1').value;
	//	document.write(a);
	var b = document.getElementById('pass2').value;
	if (a == b )
	{
		document.getElementById('cnfrmpass').innerHTML = "<font color='#00CC00'>Matched</font>";
	}
	else
	{
		document.getElementById('cnfrmpass').innerHTML = "<font color='red'>Not matched</font>";
	}
}
</script>

<html>

<?php 
	if( isset($_GET['logout_successfully'])) // 'logout_successfully' written in insert.php
	{ 
		echo $_GET['logout_successfully'];
	} 
?>

<?php
include_once('config.php');
$result = mysqli_query($conn , 'select * from country');
?>

<center>
	<table>
		<tr><br/>
			<td colspan="2"><center/><h1>Registration</h1>
			</td>
		</tr>
		<tr>
			<form method="post" action="insert.php">
			<td>Name : </td>
			<td><input type="text" name="name" required/></td>
		</tr>
		<tr>
			<td>Email : </td>
			<td><input type="email" name="email" onBlur="getEmail(this.value)" required/></td>
			<td><div id="emailDiv"></div></td>
		</tr>
		<tr>
			<td>country : </td>
			<td>
				<select name="country" required>
				<option value="">Select Country..</option>
				<?php 
				while($row = mysqli_fetch_assoc($result))
				{
				?>
					<option value="<?php echo $row['country_id'];?>"> 
						<?php echo $row['country_name']; ?> 
					</option>
				<?php
				} 
				?>
				</select>
			</td>
			<td><div id="city_display"></div></td>
		</tr>
		<tr>
			<td>Password : </td>
			<td><input type="password" name="pass1" id="pass1" required/></td>
		</tr>
		<tr><br/>
			<td>Confirm Password : </td>
			<td><input type="password" name="pass2" id="pass2" onblur="password()" /></td>
			<td>
			<div id="cnfrmpass"></div>
			</td>
		</tr><br/>
		<tr>
			<td colspan="2"><center/><input type="submit" value="Register" name="sbt" /></td>
		</tr>
	</form>
	</table> <br/><br/>

<?php 
if( isset($_GET['registeration_successfull'])) //'registeration_successfull' written in insert.php
{  
	echo $_GET['registeration_successfull']; 
} 
?>

<form method="post" action="process.php">
<table>
	<tr>
		<br/><td colspan="2"><center/> <h1>Login</h1></td>
	</tr>
	<tr>
		<td>
			Email : </td><td><input type="text" name="email"  />
		</td>
	</tr>
	<tr>
		<td> Password : </td>
		<td><input type="password" name="password" /></td>
	</tr><br/>
	<tr>
		<td colspan="2"><center/><input type="submit" name="loginbtn" /></td>
	</tr>
</table>

<?php
	if( isset($_GET['login_error']))
 	{ 
 		echo $_GET['login_error'];
 	} 
?>
</form> 
</center>
</body>
</html>