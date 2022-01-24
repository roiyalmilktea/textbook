<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>show_databases.php</title>
</head>
<body>
<?php

// データベースサーバへの接続
$db = mysql_connect('localhost','root','');

// データベースの一覧表示の関数呼び出し（ユーザ定義関数）
show_databases($db);

// データベースサーバの切断
mysql_close($db);

// ----------------------------------------------
// データベースの一覧表示の関数の定義
function show_databases($db)
{
// データベースリストの取得
$rs = mysql_list_dbs($db);

// 結果セット内のレコード数の取得
$num_rows = mysql_num_rows($rs);

print "<table border=1 cellpadding=0 cellspacing=0>\n";
print "<tr>\n";
print "<td align=center>Database</td>\n";
print "</tr>\n";

// 結果セット内のレコードを順次参照
for($i = 0; $i < $num_rows; $i++)
{
// データベース名の取得
$db_name = mysql_db_name($rs,$i);

// データベース名の表示
print "<tr>\n";
print "<td>{$db_name}</td>\n";
print "</tr>\n";
}

print "</table>\n";

// 結果セットの解放
mysql_free_result($rs);
}
?>
</body>
</html>