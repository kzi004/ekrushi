<?php
session_start();
require "dbcon.php";
$cname2 = $_SESSION['clgno'];
$cname1 = $_SESSION['cname'];
if (isset($_POST['add']))
{
  $prn = $_SESSION['uid'];

  $q3 = "SELECT `items` FROM `users` WHERE `prn` = $prn";
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
  $i_dept = $_POST['dept'];

  $i_id = $prn.'_'.$no_items;
  echo "hello";


  $query = "INSERT INTO `items`(`id`, `name`, `type`, `year`, `info`, `location`,`dept`,`clg_id`) VALUES ('$i_id','$i_name','$i_type','$i_year','$i_info','$dest','$i_dept','$cname2')";
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
<html>

<h1>Your College : <?php  echo $cname1; ?></h1>
<form action="add.php" method="post"  enctype="multipart/form-data">

  <input type="file" name="datafile"><br>
<label for="name">Name: </label><br/>
  <input type="text" name="name" id="name" required="" /><br/><br/>
  <label for="name">Type: </label><br/>
  <select name="type" required="" ><br/>
      <option value='null'>Item Type</option>
    <option value='book'>Book</option>
    <option value='stationary'>Stationary</option>
    <option value='electronics'>Electronics</option>
    <option value='notes'>Notes</option>
    <option value='vehicle'>Vehicle</option>
    </select><br/><br/>
    <label for="AY">Academic Year: </label><br/>
    <select name="year" required="">
      <option value='null'>Year</option>
      <option value='fy'>First Year</option>
      <option value='sy'>Second Year</option>
      <option value='ty'>Third Year</option>
      <option value='be'>Final Year</option>
      </select><br/><br/>

      <label for="dp">Department: </label><br/>
      <select name="dept" required="">
        <option value='nulls'>Department</option>
        <option value='computer'>Computer</option>
        <option value='civil'>Civil</option>
        <option value='electrical'>Electrical</option>
        <option value='extc'>EXTC</option>
        <option value='mech'>Mechanical</option>
        <option value='instru'>Instrumentation</option>
        </select><br/><br/>

      <label for="name">Info: </label><br/>
      <input type="textarea" name="info" id="info"/><br/><br/>

  <input type="submit" name="add" value="Add">
    <a href="logout.php" > Log-Out</a>


</form>
</html>
