<?php
// settings
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'z_site';
// connection
$con = mysqli_connect($host,$user,$password,$db);
// check connection
if (mysqli_connect_errno()) {
	echo 'Connect error';
}
// charset
mysqli_query($con, "SET NAMES UTF8");
// time zone
mysqli_query($con, "SET time_zone = '+04:00'");