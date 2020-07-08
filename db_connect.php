<?php
	$conn=mysqli_connect("localhost","root","")or die("Connection to Server failed");
	$db=mysqli_select_db($conn,"ajax")or die("Connection to Database failed");
?>