<?php
session_start();
require "dbcon.php";


$cname1 = $_SESSION['cname'];
$clg_no=$_SESSION['clgno'];
$prn = $_SESSION['uid'];
if (isset($_POST['Delete']))
{
  $iid = '\''.$_POST['delete'].'\'';
  $q3 = "SELECT `location` FROM `items` WHERE `id` = $iid";
  if($r = mysqli_query($dbconn,$q3)){
  $row2 = mysqli_fetch_assoc($r);
  $file = $row2['location'];
  if (!unlink($file))
  {
      echo ("Error deleting $file");
    }
  else
  {
    echo ("Deleted $file");
  }
}




$q = 'DELETE FROM `items` WHERE `id` = '.$iid.';';
 if($result1 = mysqli_query($dbconn,$q))
  {
    echo "success";
    $file = "test.txt";
    if (!unlink($file))
    {
        echo ("Error deleting $file");
      }
    else
    {
      echo ("Deleted $file");
    }
  }
}  //echo $_POST['delete'];

if (isset($_POST['search']))
{
  echo '
  <div class="del">
  <form action="del.php" method="post">
  <input type="text" name="delete" placeholder="Enter Id To Delete the Item">
  <input type="submit" name="Delete" value="Delete"></br></br>
  </form>
  </div>
  ';

  $key = $_POST['search_key'];
  $query = 'SELECT * FROM `items` WHERE `clg_id` = '.$clg_no.' AND `prn` = '.$prn.' AND name LIKE "%'.$key.'%" ;';
$i=0;
  if($result = mysqli_query($dbconn,$query))
  {
      while ($row = mysqli_fetch_assoc($result)) {

        echo '<br><br><br><a href=""><img src='.$row['location'].' height="300" width="300" /></a></br>';
        echo "Name: $row[name] </br> Department: $row[dept] </br>  Item Id: $row[id] </br>";

  }
    echo "</table>";

}
else {
  echo "error.........";
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
  <h1> E-Krushi</h1>
</div>







<html>
<form action="del.php" method="post">

<input type="text" name="search_key" placeholder="Search for the item"  required="">
<button class="btn" type="submit" name="search">Login</button></br></br>

</form>
</html>
