<?php
	$dbconn = mysqli_connect("localhost","root","") or die("Error........");
	$seltab = mysqli_select_db($dbconn,"project") or die("error in selecting database");
?>
