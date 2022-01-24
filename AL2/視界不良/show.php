<?php

header('Content-Type: text/html; charset=utf-8');
$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost;dbname=redkun_hello;chaeset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pid = $_GET['id'];
$sql = "select id, name, value, good from contentsdata where qid=" . $pid . ";";
$stmt = $dbh->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql2 = "select value, image from questiondata where id=" . $pid . ";";
$stmt2 = $dbh->query($sql2);
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

//print_r($result);

echo "<h1>お題</h1></br>";
echo "<h2>" . $result2[0]['value'] . "</h2><br>\n";

echo "<table border=\"1\">\n";
echo "<tr>\n";
echo "<th>名前</th><th>回答</th><th>良き</th><th>良きボタン</th>\n";
foreach ($result as $item) {
    echo "<tr>\n";
    echo "<td>" . $item['name'] . "</td>";
    echo "<td>" . $item['value'] . "</td>";
    echo "<td>" . $item['good'] . "</td>";
//    foreach ($item as $it) {
//        echo "<td>" . $it . "</td>";
//    }
    
    echo "<td><a href=good.php?id=" . $item['id'] . ">良き</a></td>\n";
    echo "<tr>\n";
}
echo "</tr>\n";
echo "</table>\n";

echo "<a href=input.php?id=".$pid.">追加</a><br><br>\n";
echo "<a href=index.php>戻る</a>\n";




