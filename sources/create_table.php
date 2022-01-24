<?php
// インクルードファイルの読み込み
include "common_mysql.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>create_table.php</title>
</head>
<body>
<?php

// データベースサーバへの接続
$db = mysql_connect('localhost','root','');

// データベースの選択
$db_name = 'test2';
mysql_select_db($db_name,$db) or die("データベースがありません");

//クライアント文字コードの通知（文字化け防止）
$str_sql = "set names utf8;";
$rs = mysql_query($str_sql,$db);


// テーブルの一覧表示
show_tables($db_name,$db);
print "<br>\n";

// テーブルが存在しない場合
$tbl_name = "tbl_test";
if(!table_exists($db_name,$tbl_name,$db))
{

// テーブル作成用SQL文
$str_sql = "CREATE TABLE {$tbl_name}"
. "("
. "shouhin_code CHAR(4),"
. "shouhin_mei CHAR(16),"
. "tanaka INTEGER,"
. "PRIMARY KEY(shouhin_code)"
. ");";
print '$str_sql= ' . "'{$str_sql}'<br><br>";

// SQL文の実行
mysql_query($str_sql,$db);
print "テーブル「{$tbl_name}」を作成しました．<br><br>\n";

// テーブルの一覧表示
show_tables($db_name,$db);
print "<br>\n";

// フィールド属性の一覧表示
show_fields($db_name,$tbl_name,$db);
print "<br>\n";
}

// テーブルが存在する場合
else
{
print "テーブル「{$tbl_name}」は作成済みです．<br>\n";
}

// テーブルが存在する場合
if(table_exists($db_name,$tbl_name,$db))
{
// テーブル削除用SQL文
$str_sql = "DROP TABLE {$tbl_name};";

// SQL文の実行
mysql_query($str_sql,$db);
print "テーブル「{$tbl_name}」を削除しました．<br><br>\n";

// テーブルの一覧表示
show_tables($db_name,$db);
print "<br>\n";
}

// テーブルが存在しない場合
else
{
print "テーブル「{$tbl_name}」はありません．<br>\n";
}

// データベースサーバの切断
mysql_close($db);

// ----------------------------------------------
// テーブルの存在チェック関数の定義

?>
</body>
</html>