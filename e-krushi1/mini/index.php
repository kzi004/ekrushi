<?php
session_start();
require "dbcon.php";
$cname1 = $_SESSION['cname'];
$clg_no=$_SESSION['clgno'];
echo '<html>

<h1>Your College : '.$cname1.'</h1>
<h3>Hello : '. $_SESSION['name'] .'</h3>
<form action="index.php" method="post">
  <input type="text" name="search_key" placeholder="Search for the item"  required="">
<input type="submit" name="search" value="Search"></br></br>
filtered search:
    </br><a href="add.php" ><input type="button" name="add" value="Add"></a></br></br>
    <a href="logout.php" > Log-Out</a>


</form>
</html>';
if (isset($_POST['search']))
{
  //echo "<table>";
  //echo "<tr><th>name</th><th>Department</th><th>Year</th></tr>";
  $key = $_POST['search_key'];
  $query = 'SELECT * FROM `items` WHERE `clg_id` = '.$clg_no.' AND name LIKE "%'.$key.'%" ;';
$i=0;
  if($result = mysqli_query($dbconn,$query))
  {
      while ($row = mysqli_fetch_assoc($result)) {

        echo '<a href=""><img src='.$row['location'].' height="300" width="300" /></a></br>';
        echo "Name: $row[name] </br> Department: $row[dept] </br>  Academic Year: $row[year] </br>";

  }
    echo "</table>";

}
else {
  echo "error.........";
}
}
?>
