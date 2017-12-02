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
          $t = "Invalid Username/Password Combination";
        }
      }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>E-Krushi</title>
	<link rel="stylesheet" type="text/css" href="bootstrap\3.3.6\css\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/jquery/1.12.0/jquery.min.js"></script>
	<script src="bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body class="back">
<div class="jumbotron">
	<h1>E-Krushi</h1>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-12 log">
			<center><h3 style="color: white;">Login</h3></center>
			<!--center><img src="images/yuna.jpg" alt="" class="img-circle" ></center-->
      <?php echo'<center><p style="color:#fff;">'.$t.'</p><center>'?>
			<div class="col-sm-12" style="display: inline-grid;">
			<br>
			<form method="POST" action="login.php">
			<div class="form-group">
			  <input type="text" name="username" class="form-control" id="usr" placeholder="Username">
			</div>
				<div class="form-group" style="background-color: #051019;box-shadow: 6px 4px 14px black;">
				  <input type="password" name="password" class="form-control" id="pwd" placeholder="Password">
				</div>

				<button class="btn" type="submit" name="login">Login</button>&nbsp&nbsp&nbsp&nbsp&nbsp
				<button class="btn"><a href="signup.php" style="text-decoration: none;color: #fff;">Sign-Up</a></button>	
				<br>
			</form>
			</div>
		</div>
	</div>
</div>
<footer class="footer">
  copyright@rajasthan.gov.in
</footer>
</body>
</html>