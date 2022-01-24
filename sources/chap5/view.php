<?php
// インクルードファイルの読み込み
include "common_mysql.php";
 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>select_alias_join.php</title>
</head>
<body>
<?php
 
 require_once('./Connections/localhost.php');
 
// データベースサーバへの接続・データベースの選択
 $mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql); 
 
// 処理対象テーブル
$tbl_name1 = "tbl_uriage_meisai";
 
$tbl_name2 = "tbl_shouhin1";
 
// SELECT文による結合（相関名の使用）
$str_sql1 = "SELECT M.denpyo_code,"
. "M.shouhin_code,"
. "M.kosuu,"
. "S.shouhin_mei,"
. "S.tanka"
. " FROM {$tbl_name1} M, {$tbl_name2} S"
. " WHERE M.shouhin_code = S.shouhin_code";
 
// VIEWの定義用SQL文
$str_sql2 = "CREATE VIEW viw_uriage_meisai AS $str_sql1;";
 
// VIEWの定義用SQL文の実行
$rs2 = $mysqli->query($str_sql2);
print "\"{$str_sql2}\"<br><br>\n";
 
// ビューを使ったSQL文（その１）
$str_sql3 = "SELECT * FROM viw_uriage_meisai;";
 
$rs3 = $mysqli->query($str_sql3);
print "\"{$str_sql3}\"<br>\n";
// 結果セットの表示
show_rs($rs3);
print "<br>\n";
 
// ビューを使ったSQL文（その２）
$str_sql4 = "SELECT * FROM viw_uriage_meisai WHERE tanka >= 300;";
 
$rs4 = $mysqli->query($str_sql4);
print "\"{$str_sql4}\"<br>\n";
// 結果セットの表示
show_rs($rs4);
print "<br>\n";
 
// 結果セット（結果ID）の開放
mysqli_free_result($rs3);
mysqli_free_result($rs4);
 
// データベースサーバの切断
$mysqli->close();
 
?>
</body>
</html>