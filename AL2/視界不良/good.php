<?php

header('Content-Type: text/html; charset=utf-8');
$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost;dbname=redkun_hello;chaeset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$aid = $_GET['id'];
$sql = "select qid, good from contentsdata where id=" . $aid . ";";
$stmt = $dbh->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "UPDATE redkun_hello.contentsdata SET good = ".($result[0]['good'] + 1)." WHERE contentsdata.id = " . $aid . ";";
$stmt2 = $dbh->query($sql2);

header('Location:show.php?id='.$result[0]['qid']);
//print_r($result);
