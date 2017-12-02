<?php
	session_start();
  //require_once "dbcon.php";
  require "dbcon.php";
	$cname2 = $_SESSION['clgno'];
	$cname1 = $_SESSION['cname'];
	$prn=$_SESSION['uid'];
  //print_r($_POST);

	if (isset($_POST['register']))
	{

		$name = $_POST['name'];
		$lname = $_POST['lname'];
    $email = $_POST['adhar'];
		$mobile_no = $_POST['mobile_no'];

		$dest='./'.$cname2.'/'.$_SESSION['uid'].'.jpg';
		$source = $_FILES['datafile']['tmp_name'];
		if (file_exists($dest)) {
		    unlink($dest);
				move_uploaded_file($source,$dest);

		} else {
		    move_uploaded_file($source,$dest);
		}
$q="UPDATE `users` SET `name`= '$name',`lname`='$lname',`mobile`='$mobile_no',`adhar` = '$email',`profile`='$dest'  WHERE `prn` = '$prn';";

//$query = "INSERT INTO `users` ( `name`, `lname`, `mobile`, `loginid`, `password`, `email`, `college`,`prn`) VALUES ( '$name', '$lname', '$mobile_no', '$username', '$password','$email','$cname','$prn')";
			//echo $query;
				if ($result = mysqli_query($dbconn,$q))
				{
					//mkdir($prn.'_'.$cname);
			//		echo "<script> alert(\"User Added Successfully!! Plzz Login to continue...!!\"); </script>";
					header("Location:index.php");
				}
				else
					echo "Unable to add user!!";
			}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="bootstrap\3.3.6\css\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/edit.css">
	<script src="js/jquery/1.12.0/jquery.min.js"></script>
	<script src="bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body class="back">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Multistore&nbsp:&nbsp<?php echo $cname1;?></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">HOME</a></li>
        <li><a onclick="openNav()" style="cursor: pointer;">MENU</a></li>
        <li><a data-toggle="modal" data-target="#myModal" style="cursor: pointer;">ADD</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding-top: 15px;"><?php echo $_SESSION['name'];?>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" style="padding-top: 8px;">
            <li><a href="editpro.php">Edit Profile</a></li>
            <li><a href="del.php">Remove Item</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="jumbotron">
	<h1 style="    letter-spacing: 17px;
    opacity: 0.5;">
		Edit Profile
	</h1>
</div>
<div class="container-fluid test1">
<div class="row">
<div class="col-md-8">
<form method="POST" action="editpro.php" enctype="multipart/form-data">
	<div class="form-group">
	<input type="text" name="name" class="form-control" id="name" placeholder="Firstname" >
	</div>

	<div class="form-group">
	<input type="text" name="lname" class="form-control" id="lname" placeholder="Lastname">
	</div>


	<div class="form-group">
	<input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="Mobile Number">
	</div>


	<div class="form-group">
	<input type="text" name="adhar" class="form-control" id="email" placeholder="adhar">
	</div>
	<button class="btn" name="register" type="submit">Save</button>
  </div>
<div class="col-md-4">
	<img src="#" class="img-responsive img2" id="blah">
	          <div class="form-group">
          <label class="custom-file-upload">
      <input type="file" name="datafile"  id="imgInp" style="display: none;" />
    Image Upload
    </label>
          </div>
</div>
</form>
</div>

</div>
</div>
<script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});
</script>
</body>
</html>
