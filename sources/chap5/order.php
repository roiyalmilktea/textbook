<?php
// インクルードファイルの読み込み
include "common_mysql.php";
 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>order.php</title>
</head>
<body>
<?php
 
 require_once('./Connections/localhost.php');
 
 // データベースサーバへの接続
 $mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql); 
 
 // レコードを並べ替えるテーブル
 $tbl_name = "tbl_shouhin_hyou2";
 
 // テーブルの中の全レコード一覧表示
 show_records($db_name,$tbl_name,$mysqli);
 print "<br>\n";
 
 // レコードの並べ替え
 $str_sql = "SELECT * FROM {$tbl_name}"
       . " ORDER BY tanka;";
 
 // SQL文の実行
 $rs = $mysqli->query($str_sql);
 
 // SQL文の表示
 print "\"{$str_sql}\"<br>\n";
 
 // 結果セットの中の全レコード一覧表示
 show_rs($rs);
 print "<br>\n";
 
 // レコードの逆順での並べ替え
 $str_sql = "SELECT * FROM {$tbl_name}"
       . " ORDER BY tanka DESC;";
 
 // SQL文の実行
 $rs = $mysqli->query($str_sql);
 
 // SQL文の表示
 print "\"{$str_sql}\"<br>\n";
 
 // 結果セットの中の全レコード一覧表示
 show_rs($rs);
 
 // データベースサーバの切断
 $mysqli->close()
 
?>
</body>
</html>