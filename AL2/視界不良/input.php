<?php

header('Content-Type: text/html; charset=utf-8');
$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost;dbname=redkun_hello;chaeset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pid = $_GET['id'];
$sql = "select value from questiondata where id=" . $pid . ";";
$stmt = $dbh->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<h>" . $result[0]['value'] . "</h><br>\n";
echo "<form method=\"post\" action=\"new.php?id=" . $pid . "\">\n";
echo "名前<input type=\"text\" name=\"name\"><br>\n";
echo "回答<input type=\"text\" name=\"value\"><br>\n";
echo "<input type=\"submit\" value=\"送信\"><br>\n";
echo "</form><br>\n";

echo "<a href=index.php>戻る</a>\n";

