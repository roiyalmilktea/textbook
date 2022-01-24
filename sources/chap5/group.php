<?php
// インクルードファイルの読み込み
include "common_mysql.php";
 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>group.php</title>
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
 $tbl_name = "tbl_shouhin";
 show_records($db_name,$tbl_name,$mysqli);
 print "<br>\n";
 
 // グループ化
 $str_sql1 = "SELECT hinmoku,COUNT(*) FROM tbl_shouhin"
      . " GROUP BY hinmoku;";
 $rs1 = $mysqli->query($str_sql1);
 print "\"{$str_sql1}\";<br>\n";
 
 // 結果セットの表示
 show_rs($rs1);
 print "<br>\n";
 
 // グループ化
 $str_sql2 = "SELECT hinmoku,SUM(tanka) FROM tbl_shouhin"
      . " GROUP BY hinmoku;";
 $rs2 = $mysqli->query($str_sql2);
 print "\"{$str_sql2}\";<br>\n";
 
 // 結果セットの表示
 show_rs($rs2);
 print "<br>\n";
 
 // HAVING句
 $str_sql3 = "SELECT hinmoku,SUM(tanka) FROM tbl_shouhin"
      . " GROUP BY hinmoku"
      . " HAVING SUM(tanka) > 800;";
 $rs3 = $mysqli->query($str_sql3);
 print "\"{$str_sql3}\";<br>\n";
 
 // 結果セットの表示
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