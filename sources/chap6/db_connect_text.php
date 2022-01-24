<?php

$DBSERVER = "localhost";
$DBUSER = "admin";
$DBPASSWORD = "password";
$DBNAME = "student";

$mysqli = new mysqli($DBSERVER, $DBUSER, $DBPASSWORD, $DBNAME);

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_set_charset($mysqli,"utf8");
