<?php
header('Content-Type: text/html; charset=utf-8');
//$user = "redkun_user";
//$pass = "user24910";
//$dbh = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=redkun_hello;chaeset=utf8', $user, $pass);
//$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$pid = $_GET['id'];
//$sql = "select value from questiondata where id=" . $pid . ";";
//$stmt = $dbh->query($sql);
//$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//echo "<h>" . $result[0]['value'] . "</h><br>\n";
echo "<h2>お題の新規作成</h2><br>\n";
echo "<form method=\"post\" action=\"newq.php\">\n";
echo "お題：<input type=\"text\" name=\"value\"><br>\n";
echo "<input type=\"submit\" value=\"送信\"><br>\n";
echo "</form>\n";

echo "<a href=index.php>戻る</a>\n";

