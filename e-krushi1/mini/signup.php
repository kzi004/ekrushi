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
    $prn=$_POST['prn'];
		$cname = $_POST['collegename'];
		$email = $_POST['email'];
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
				$query = "INSERT INTO `users` ( `name`, `lname`, `mobile`, `loginid`, `password`, `email`, `college`,`prn`) VALUES ( '$name', '$lname', '$mobile_no', '$username', '$password','$email','$cname','$prn')";
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
<form method="POST" action="signup.php">
  <center>
	<label for="name">First Name: </label><br/>
	<input type="text" name="name" id="name" required="" /><br/><br/>

	<label for="lname">Last Name: </label><br/>
	<input type="text" name="lname" id="lname"  required=""/><br/><br/>

	<label for="mobno">Mobile No.: </label><br/>
	<input type="text" name="mobile_no" id="mobile_no"  required="" maxlength="10"/><br/><br/>

	<label for="email">Email: </label><br/>
	<input type="email" name="email" id="email" required="" /><br/><br/>

  <label for="email">P.R.N.</label><br/>
	<input type="text" name="prn" id="prn" required="" /><br/><br/>

	<label for="username">Username: </label><br/>
	<input type="text" name="username" id="username" required="" /><br/><br/>

	<label for="password">Password: </label><br/>
	<input type="password" name="password" id="password" required="" /><br/><br/>

	<label for="cpass">Confirm Password: </label><br/>
	<input type="password" name="cpassword" id="cpassword" required="" /><br/><br/>

	<label for="name">College Name: </label><br/>
  <select name="collegename" required="">
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
  <br><br>
	<input type="submit" name="register" value="Register">
	<a href="login.php"><input type="button" value="Sign-In"></a>

</form>
</center>
