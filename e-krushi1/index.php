<?php
session_start();
require "dbcon.php";
$cname1 = $_SESSION['cname'];
$cname2 = $_SESSION['clgno'];
$clg_no = $_SESSION['clgno'];

if (isset($_POST['add']))
{

  $r = mysqli_query($dbconn,$q3);
  $row = mysqli_fetch_assoc($r);

  $no_items = $row['items'];
  $no_items += 1;
  $dest='./'.$cname2.'/'.$_SESSION['uid'].'_'.$no_items.'.jpg';

  $source = $_FILES['datafile']['tmp_name'];
  move_uploaded_file($source,$dest);
  $i_name= $_POST['name'];
  $i_type= $_POST['type'];
  $i_year= $_POST['year'];
  $i_info= $_POST['info'];
  $i_dept= $_POST['dpt'];

  $i_id = $prn.'_'.$no_items;


  $query = "INSERT INTO `items`(`id`, `name`, `type`, `year`, `info`, `location`,`clg_id`) VALUES ('$i_id','$i_name','$i_type','$i_year','$i_info','$dest','$cname2')";
  if ($result = mysqli_query($dbconn,$query))

  {
    //echo "<script> alert(\"Item Added Successfully!! Plzz Login to continue...!!\"); </script>";
    $q2 = "UPDATE `users` SET `items` = $no_items WHERE `users`.`prn` = $prn";
    $result2 = mysqli_query($dbconn,$q2);
    header("Location:index.php");
  }
  else
    echo "Unable to add item!!";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>index</title>
  <link rel="stylesheet" type="text/css" href="bootstrap\3.3.6\css\bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="js/jquery/1.12.0/jquery.min.js"></script>
  <script src="bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body id="test">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">E-Krushi Center&nbsp:&nbsp<?php echo $cname1;?></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">HOME</a></li>
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
<br>
<div class="container-fluid text-center" style="background-color: #fff;padding-top: 7%;padding-bottom: 7%;background-image: url(images/19.jpg);
    background-size: 100% 111%;">
  <h1 style="font-size: 55px;letter-spacing: 90px; font-family: -webkit-body; color: #fff">E-KRUSHI</h1>
  <br>
  <p style="font-size: 25px;font-family: -webkit-body;
    letter-spacing: 9px; color: #fff">"Government of Rajasthan Portal initiative"</p>
</div>
<div class="container">
  <form action="index.php" method="post">
  <div class="dis">
  <input type="text" name="search_key" required="" class="form-control" placeholder="Search here...">
  <button type="submit" name="search" value="Search" class="btn">GO</button>
  </div>
  </form>
</div>
<div class="container-fluid">
  <div class="row te">
   <?php if (isset($_POST['search']))
{
  $key = $_POST['search_key'];
  $query = 'SELECT * FROM `items` WHERE `clg_id` = '.$cname2.' AND name LIKE "%'.$key.'%" ;';
$i=0;
  if($result = mysqli_query($dbconn,$query))
  {
      echo '<span class="he"><p>Your Results</p></span>';
      while ($row = mysqli_fetch_assoc($result)) {

        echo '<div class="col-md-4">
      <div class="test">
      <div class="row">
      <div class="col-md-6">
      <img src='.$row['location'].' class="img-responsive img1" height=150 width=150>
      </div>
      <div class="col-md-6 c">
      ';
       echo '<p><b>Name:&nbsp&nbsp</b>$row[name]</p>
      <p><b>Sowing Year:</b>$row[year]</p>
      <p><b>Contact:</b>'.$mobile.'</p>
      </div>
      </div>
      </div>
    </div>';

  }
}
else {
  echo "error.........";
}
}?>
  </div>
</div>
<div class="container-fluid" style="padding-bottom: 20px;">
<h3 style="text-align: center;
    font-size: 38px;
    letter-spacing: 42px;color: #46152a;">RECENTLY ADDED</h3>
  <div class="row te">
<?php


  $query = 'SELECT * FROM `items` WHERE `clg_id` = '.$clg_no.' ;';
$i=0;
if($result = mysqli_query($dbconn,$query))
{
    while ($row = mysqli_fetch_assoc($result)) {


$prn1=$row['prn'];
$query1 = 'SELECT * FROM `users` WHERE `prn` = '.$prn1.' ;';
if($result1 = mysqli_query($dbconn,$query1))
{
    //echo "success";
$row1 = mysqli_fetch_assoc($result1);
$contact=$row1['mobile'];
//echo $contact;
}
    echo '<div class="col-md-4">
      <div class="test">
      <div class="row">
      <div class="col-md-6">
      <img src='.$row['location'].' class="img-responsive img1">
      </div>
      <div class="col-md-6 c">
      <span>
        <p><b>Name:&nbsp&nbsp</b>'.$row['name'].'</p>
      <p><b>Sowing Year:&nbsp&nbsp</b>'.$row['year'].'</p>
      <p><b>Contact:&nbsp&nbsp</b>'.$contact.'</p>
      </span>
      </div>
      </div>
      </div>
    </div> ';

  }

  }
    ?>
  </div>
</div>
<div id="mySidenav" class="sidenav" style="box-shadow: 6px 8px 31px black">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="
    color: #000;
    padding-top: 46px;
    padding-right: 5px;
    text-decoration: none;
">&times;</a>
    <img src="images/23.jpg" class="cik">
    <?php

    $query2 = 'SELECT * FROM `users` WHERE `prn` = '.$prn.' ;';
    if($result2 = mysqli_query($dbconn,$query2))
    {
        //echo "success";
    $row2 = mysqli_fetch_assoc($result2);
    $dp=$row2['profile'];
    //echo $contact;
    }



    echo '<img src= '.$dp.' class="si">';
    ?>
     <ul class="u">
  <li class="active l">
 <span class="glyphicon glyphicon-home"></span><a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Home</a>
 </li>
  <li class="active l">
 <a href="editpro.php"><i class="fa fa-fw fa-dashboard waves-effect" s></i>Edit Profile</a>
 </li>
 <li class="active l">
 <a href="index.html"><i class="fa fa-fw fa-dashboard"></i>Items</a>
 </li>
 <li class="active l">
 <a href="index.html"><i class="fa fa-fw fa-dashboard"></i>Help</a>
 </li>
 <li class="active l">
 <span class="glyphicon glyphicon-off"></span><a href="logout.php"><i class="fa fa-fw fa-dashboard"></i> Log out</a>
 </li>
  </ul>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="margin-left:-76px;width: 133%">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><span class="glyphicon glyphicon-lock"></span>ADD ITEM</h4>
      </div>
      <div class="modal-body">
        <div class="container" style="width: inherit;">
          <div class="row">
          <form action="add.php" method="post"  enctype="multipart/form-data">
            <div class="col-md-3">
              <img src="#" class="img-responsive img2" id="blah">
            </div>
            <div class="col-md-9">
          <div class="form-group">
          <label class="custom-file-upload">
      <input type="file" name="datafile"  id="imgInp" />
    Custom Upload
    </label>
          </div>
          <div class="form-group">
          <input type="textarea" name="name" id="name" class="form-control frm1" required="" placeholder="Name of Product" />
          </div>
          <div class="form-group">
          <select name="type" required="" class="frm"><br/>
      <option value='null'>Crop Type</option>
      <option value='Kharif'>Kharif</option>
      <option value='Rabi '>Rabi</option>
    </select>
          </div>
          <div class="form-group">
          <select name="year" required="" class="frm">
      <option value='null'>Year of sowing</option>
      <option value='current'>Current Year</option>
      <option value='less than 2'> less than 2 Years</option>
      <option value='more than 2'>more than 2 Years</option>
      <option value='more than 5'>more than 5 Years</option>
      </select>
          </div>
          <div class="form-group">
          <input type="textarea" name="info" id="info" class="form-control frm1" placeholder="Information" />
          </div>
          <div class="form-group">
          <button type="submit" name="add" value="ADD" class="btn" style="height: 37px;
    padding-top: 7px;background-color: #051019;
    border-radius: 0px;">add</button>
          </div>
            </div>
          </div>
        </div>
      </div>
      </form>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default pull-left" data-dismiss="modal" style="
    background-color: #051019;
    border: 0;
">
          <span class="glyphicon glyphicon-remove"></span> Cancel
        </button>
        <p style="color: #fff">Need<a href="#">help?</a></p>
      </div>
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
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "350px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
<script src="js/SmoothScroll.js"></script>
<script src="js/jarallax.js"></script>
</body>
</html>
