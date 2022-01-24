<?php

header('Content-Type: text/html; charset=utf-8');
$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost;dbname=redkun_hello;chaeset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "INSERT INTO questiondata (id, value, image, text) VALUES (NULL, '" . $_POST['value'] . "', NULL, NULL);";
$stmt = $dbh->query($sql);
//$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Location: index.php');

