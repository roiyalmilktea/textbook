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
 // 後方一致検索
 $str_sql = "SELECT * FROM {$tbl_name} "
       . " WHERE shouhin_mei LIKE '%定食';";
 
 // SQL文の実行
 $rs = $mysqli->query($str_sql);
 
 // 結果セットの中の全レコード一覧表示
 print "\"{$str_sql}\"<br>\n";
 show_rs($rs);
 print "<br>\n";
 
 // 前方一致検索
 $str_sql = "SELECT * FROM {$tbl_name} "
       . " WHERE shouhin_mei LIKE '山%';";
 
 // SQL文の実行
 $rs = $mysqli->query($str_sql);
 
 // 結果セットの中の全レコード一覧表示
 print "\"{$str_sql}\"<br>\n";
 show_rs($rs);
 print "<br>\n";
 
 // 部分一致検索
 $str = '幸';
 $str_sql = "SELECT * FROM {$tbl_name} "
       . " WHERE shouhin_mei LIKE '%{$str}%';";
 
 // SQL文の実行
 $rs = $mysqli->query($str_sql);
 
 // 結果セットの中の全レコード一覧表示
 print "\"{$str_sql}\"<br>\n";
 show_rs($rs);
 print "<br>\n";
 
 // データベースサーバの切断
 $mysqli->close();
 
?>
</body>
</html>