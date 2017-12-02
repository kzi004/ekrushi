<?php
	session_start();
	$_SESSION['uid']=0;
	require_once "dbcon.php";


		if (isset($_POST['login']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];

			$query = "SELECT `prn`,`college`,`items`,`name` FROM `users` WHERE `loginid` = '$username' AND `password` = '$password'";
			if ($result = mysqli_query($dbconn,$query))
			{
				if (mysqli_num_rows($result) == 1)
				{
					$row = mysqli_fetch_assoc($result);
					$id = $row['prn'];
					$_SESSION['uid'] = $id;
					$_SESSION['uname']=$username;
					$_SESSION['nos'] = $row['items'];
					$college = $row['college'];
					$_SESSION['clgno'] = $college ;
					$_SESSION['name'] = $row['name'] ;
					$query1 = "SELECT `name`, `id` FROM `colleges` WHERE `id` = '$college'";
					if ($result1 = mysqli_query($dbconn,$query1))
					{
						if (mysqli_num_rows($result1) == 1)
						{
							$row1 = mysqli_fetch_assoc($result1);
							$_SESSION['cname']= $row1['name'];
						}
					}
					header("Location:index.php");
				}
				else
				{
					echo "Invalid Username/Password Cobination";
				}
			}
		}
?>

<form method="POST" action="login.php">
	<label for="username">Username: </label><br/>
	<input type="text" name="username" id="username"  /><br/><br/>

	<label for="password">Password: </label><br/>
	<input type="password" name="password" id="password"  /><br/><br/>

	<input type="submit" name="login" value="Log-In">

	<br>
	<br>

	<input type="button" value="Sign-Up" onclick="location.href='signup.php'">
</form>
