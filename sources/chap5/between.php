<?php
// インクルードファイルの読み込み
include "common_mysql.php";
 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>like.php</title>
</head>
<body>
<?php
 
 require_once('./Connections/localhost.php');
 
 // データベースサーバへの接続・データベースの選択
 $mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql); 
 
 // 検索対象テーブル
 $tbl_name = "tbl_shouhin_hyou3";
 show_records($db_name,$tbl_name,$mysqli);
 print "<br>\n";
 
 // あいまい検索（LIKE演算子）
 // 文字列長を指定したい場合
 // (鶴亀の後に任意の2文字を含む４文字の文字列を検索する例）
 $str_sql = "SELECT * FROM {$tbl_name} "
       . " WHERE shouhin_mei LIKE '鶴亀__';";
 
 // SQL文の実行
 $rs1 = $mysqli->query($str_sql);
 
 // 結果セットの中の全レコード一覧表示
 print "\"{$str_sql}\"<br>\n";
 show_rs($rs1);
 print "<br>\n";
 
 // IN演算子
 $str_sql = "SELECT * FROM {$tbl_name} "
       . " WHERE tanka IN(1000,1500);";
 
 // SQL文の実行
 $rs2 = $mysqli->query($str_sql);
 
 // 結果セットの中の全レコード一覧表示
 print "\"{$str_sql}\"<br>\n";
 show_rs($rs2);
 print "<br>\n";
 
 // BETWEEN演算子
 $str_sql = "SELECT * FROM {$tbl_name} "
       . " WHERE tanka BETWEEN 2000 AND 3000;";
 
 // SQL文の実行
 $rs3 = $mysqli->query($str_sql);
 
 // 結果セットの中の全レコード一覧表示
 print "\"{$str_sql}\"<br>\n";
 show_rs($rs3);
 print "<br>\n";
 
 // 結果セット（結果ID）の開放
 mysqli_free_result($rs1);
 mysqli_free_result($rs2);
 mysqli_free_result($rs3);
 
 // データベースサーバの切断
 $mysqli->close();
 
?>
</body>
</html>