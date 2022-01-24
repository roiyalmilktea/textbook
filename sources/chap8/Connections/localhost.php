<?php
$host = "localhost";
$database = "test_blog";
$user = "root";
$pass = "root";

$mysqli = new mysqli($host, $user, $pass, $database);

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_set_charset($mysqli,"utf8");

?>