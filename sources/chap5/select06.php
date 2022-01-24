<?php
// インクルードファイルの読み込み
include "common_mysql.php";
 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>select06.php</title>
</head>
<body>
<?php
 
 require_once('./Connections/localhost.php');
 
 // データベースサーバへの接続
 $mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql);
 
 
 // 参照するテーブル
 $tbl_name = "tbl_shouhin_hyou";
 
 // 全レコード，全フィールド表示用SQL文の作成
 $str_sql = "SELECT * FROM {$tbl_name};";
 
 // SQL文の実行
 $rs = $mysqli->query($str_sql);
 
 // テーブルの全レコードの一覧表示
 print "テーブル「{$tbl_name}」の全レコード，全フィールドデータ一覧<br>\n";
 show_rs($rs);
 print "<br>\n";
 
 // 結果セットの解放
 mysqli_free_result($rs);
 
 // 指定したフィールドのみを参照するSQL文の作成
 $str_sql = "SELECT shouhin_mei,tanka FROM {$tbl_name};";
 
 // SQL文の実行
 $rs2 = $mysqli->query($str_sql);
 
 // 結果セットの表示
 print "\"{$str_sql}\"<br>\n";
 show_rs($rs2);
 print "<br>\n";
 
 // 結果セットの解放
 mysqli_free_result($rs2);
 
 // 条件にあったレコードのみを抽出するSQL文の作成
 $str_sql = "SELECT * FROM {$tbl_name}"
      . " WHERE shouhin_code = 1002";
 
 // SQL文の実行
 $rs3 = $mysqli->query($str_sql);
 
 // 結果セットの表示
 print "\"{$str_sql}\"<br>\n";
 show_rs($rs3);
 print "<br>\n";
 
 // 結果セットの解放
 mysqli_free_result($rs3);
 
 // 条件にあったレコードの指定のフィールド名みを抽出するSQL文の作成
 $str_sql = "SELECT shouhin_mei,tanka FROM {$tbl_name}"
      . " WHERE shouhin_mei = '海の幸御前'";
 
 // SQL文の実行
 $rs4 = $mysqli->query($str_sql);
 
 // 結果セットの表示
 print "\"{$str_sql}\"<br>\n";
 show_rs($rs4);
 print "<br>\n";
 
 // 結果セットの解放
 mysqli_free_result($rs4);
 
 // データベースサーバの切断
 $mysqli->close();
 
?>
</body>
</html>