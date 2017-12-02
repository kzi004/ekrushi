<?php
	session_start();
  //require_once "dbcon.php";
  require "dbcon.php";
  //print_r($_POST);
	if (isset($_POST['register']))
	{
    echo "hello";
		$flag=0;
		$username = $_POST['username'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		$name = $_POST['name'];
		$lname = $_POST['lname'];
		$cname = $_POST['collegename'];
		$adhar = $_POST['adhar'];
		$mobile_no = $_POST['mobile_no'];

	$print="SELECT * FROM `users`";
	$sql=mysqli_query($dbconn,$print);
		while($rowsel=mysqli_fetch_assoc($sql))
		{
			if ($username == $rowsel['loginid'])
			{
				echo "<script> alert(\"Username Already Exists...!!\"); </script>";

				$flag=1;
				break;
			}
		}
		if ($flag == 0)
		{
			if ($password == $cpassword)
			{
				$query = "INSERT INTO `users` ( `name`, `lname`, `mobile`, `loginid`, `password`, `adhar`, `college`) VALUES ( '$name', '$lname', '$mobile_no', '$username', '$password','$adhar','$cname')";
			//echo $query;
				if ($result = mysqli_query($dbconn,$query))
				{
					//mkdir($prn.'_'.$cname);
					echo "<script> alert(\"User Added Successfully!! Plzz Login to continue...!!\"); </script>";
					header("Location:login.php");
				}
				else
					echo "Unable to add user!!";
			}

		}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="bootstrap\3.3.6\css\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/signup.css">
	<script src="js/jquery/1.12.0/jquery.min.js"></script>
	<script src="bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body class="back">
<div class="jumbotron">
	<h1 style="    letter-spacing: 17px;
    opacity: 0.5;">
		Signup
	</h1>
</div>
<div class="container-fluid test1">
<div class="row">
<div class="col-xl-8">
<form method="POST" action="signup.php">
	<div class="form-group">
	
	<input type="text" name="name" class="form-control" id="name" placeholder="Firstname" required="">
	</div>

	<div class="form-group">
	<input type="text" name="lname" class="form-control" id="lname" placeholder="Lastname" required="">
	</div>


	<div class="form-group">
	<input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="Mobile Number">
	</div>


	<div class="form-group">
	<input type="text" name="adhar" class="form-control" id="email" placeholder="Adhar Card">
	</div>

	<div class="form-group">
	<input type="text" name="username" class="form-control" id="usr" placeholder="Username">
	</div>

	<div class="form-group">
	<input type="password" name="password" class="form-control" id="usr" placeholder="Password">
	</div>

	<div class="form-group">
	<input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Confirm Password">
	</div>

	<div class="form-group">
  <select class="sel" name="collegename" placeholder="clo" required="">
    <?php
    //for ($i=0; $i < 10 ; $i++) {
$query3 = "SELECT * FROM `colleges`";
$result1 = mysqli_query($dbconn,$query3);


while ($row1 = mysqli_fetch_assoc($result1)) {
	# code...

    echo '<option value='.$row1['id'].'>'.$row1['name'].'</option>';
  }
    ?>
  </select>
  </div>
  <br>
  <button class="btn" name="register" type="submit">Register</button>
  <button class="btn" onclick="location.href='login.php'">Log-In</button>
</form>
</div>
<div class="col-md-4">
</div>
</div>
</div>
</body>
</html>

