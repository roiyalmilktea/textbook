<html>
<head>
<title>connect.php</title>
</head>
<body>
<?php

print "データベースへの接続テスト<br>";

//データベースサーバ名の設定
$db_host = "localhost";

//ユーザ名の設定
$db_user = "root";

//パスワードの設定
$db_passwd = "";

//データベースサーバへの接続
$db = mysql_connect($db_host,$db_user,$db_passwd);

//データベース名の設定
$db_name = "test2";

//データベースの選択
mysql_select_db($db_name,$db);

//クライアント文字コードの通知（文字化け防止）
$str_sql = "set names utf8;";
$rs = mysql_query($str_sql,$db);

//SQL文の設定
$str_sql = "select * from hyou1";

//SQL文の実行
$rs = mysql_query($str_sql,$db);

//結果セット内の各レコードを順次参照し，連想配列に代入
while($arr_item = mysql_fetch_assoc($rs))
{

//レコード内の各フィールド名と値を順次参照
foreach($arr_item as $key => $value)
{
//フィールド名と値を表示
print "[{$key}] = {$value}<br>\n";
}
print "<br>\n";
}

//データベースサーバへの接続の切断
mysql_close($db);

?>
</body>
</html>