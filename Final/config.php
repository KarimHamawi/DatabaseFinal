<?php
session_start();
$host = "localhost"; 
$port = 3306;
$user = "root"; 
$password = ""; 
$dbname = "hospital"; 


$con = mysqli_connect($host, $user, $password,$dbname,$port);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
