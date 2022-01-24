<?php
// インクルードファイルの読み込み
include "common_mysql.php";
 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>include.php</title>
</head>
<body>
<?php
 
 require_once('./Connections/localhost.php');
 
 // データベースサーバへの接続
 $mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql);
 // レコードを追加するテーブル
 $tbl_name = "tbl_shouhin_hyou";
 
 // テーブルの中の全レコード一覧表示
 show_records($db_name,$tbl_name,$mysqli);
 print "<br>\n";
 
 // レコード追加のSQL文の作成
 $str_sql = "INSERT INTO {$tbl_name} "
      . "(shouhin_code,shouhin_mei ,tanka)"
      . " VALUES "
      . "('2001' ,'ランチ',800);";
 
 // SQL文の実行
 $mysqli->query($str_sql);
 
 // SQL文の表示
 print "\"{$str_sql}\"<br>\n";
 
 // テーブルの中の全レコード一覧再表示
 show_records($db_name,$tbl_name,$mysqli);
 
 // データベースサーバの切断
 $mysqli->close();
 
?>
</body>
</html>