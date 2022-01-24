<?php
// インクルードファイルの読み込み
include "common_mysql.php";
 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>natural_join.php</title>
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
 print "「{$tbl_name1}」<br>\n";
 show_records($db_name,$tbl_name1,$mysqli);
 print "<br>\n";
 
 $tbl_name2 = "tbl_shouhin1";
 print "「{$tbl_name2}」<br>\n";
 show_records($db_name,$tbl_name2,$mysqli);
 print "<br>\n";
 
 // 自然結合（NATURAL JOIN句）
 $str_sql1 = "SELECT * FROM {$tbl_name1}"
      . " NATURAL JOIN {$tbl_name2};";
 $rs1 = $mysqli->query($str_sql1);
 print "\"{$str_sql1}\"<br>\n";
 
 // 結果セットの表示
 show_rs($rs1);
 print "<br>\n";
 
 // 結果セット（結果ID）の開放
 mysqli_free_result($rs1);
  
 
 // データベースサーバの切断
 $mysqli->close();
 
?>
</body>
</html>