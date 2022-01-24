<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>show_tables.php</title>
</head>
<body>
<?php

// データベースサーバへの接続
$db = mysql_connect('localhost','root','');

// テーブルの一覧表示の関数呼び出し（ユーザ定義関数）
show_tables('test2',$db);

// データベースサーバの切断
mysql_close($db);

// ----------------------------------------------
// テーブルの一覧表示の関数の定義
function show_tables($db_name,$db)
{
// 指定されたデータベース内のテーブルリストの取得
$rs = mysql_list_tables($db_name,$db);

// 結果セット内のレコード数の取得
$num_rows = mysql_num_rows($rs);

print "<table border=1 cellpadding=0 cellspacing=0>\n";
print "<tr>\n";
print "<td align=center>Tables in {$db_name}</td>\n";
print "</tr>\n";

// テーブルがある場合
if($num_rows > 0)
{
// 結果セット内のレコードを順次参照
for($i = 0; $i < $num_rows; $i++)
{
// テーブル名の取得
$table_name = mysql_table_name($rs,$i);

// テーブル名の表示
print "<tr>\n";
print "<td>{$table_name}</td>\n";
print "</tr>\n";
}
}

// テーブルが無い場合
else
{
print "<tr>\n";
print "<td>テーブルはありません</td>\n";
print "</tr>\n";
}
print "</table>\n";

// 結果セットの解放
mysql_free_result($rs);
}
?>
</body>
</html>