<?php

header('Content-Type: text/html; charset=utf-8');
$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost;dbname=redkun_hello;chaeset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pid = $_GET['id'];
$sql = "select * from contentsdata";
$stmt = $dbh->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql2 = "select * from questiondata";
$stmt2 = $dbh->query($sql);
$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

//print_r($result);
echo "<table border=\"1\">\n";
echo "<tr>\n";
echo "<th>名前</th><th>回答</th><th>良き</th>\n";
foreach ($result as $item) {
    echo "<tr>\n";
    foreach ($item as $it) {
        echo "<td>" . $it . "</td>";
    }
    echo "\n";
    echo "<tr>\n";
}
echo "</tr>\n";
echo "</table>\n";
echo "<a href=index.php>戻る</a>";




