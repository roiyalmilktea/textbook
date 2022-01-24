<?php

header('Content-Type: text/html; charset=utf-8');
$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost;dbname=redkun_hello;chaeset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pid = $_GET['id'];

$name = $_POST['name'];
if ($name == "") {
    $name = "名無しの学生";
}
$sql = "INSERT INTO contentsdata (id, qid, name, value, good, text) VALUES (NULL, '" . $pid . "', '" . $name . "', '" . $_POST['value'] . "', '0', NULL);";
$stmt = $dbh->query($sql);
//$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Location: show.php?id='.$pid);

