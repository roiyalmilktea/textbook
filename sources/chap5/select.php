<?php
// インクルードファイルの読み込み
include "common_mysql.php";
 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>select.php</title>
</head>
<body>
<?php
 
 require_once('./Connections/localhost.php');
 
 // データベース名
 $db_name = 'my_blog';
 
 // データベースサーバへの接続
 $mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql);
 
 
 // 参照するテーブル
 $tbl_name = "tbl_shouhin_hyou";
 
 // SQL文の作成
 $str_sql = "SELECT * FROM {$tbl_name}";
 
 print '$str_sql= ' . "'{$str_sql}'<br><br>";
 
 // SQL文の実行
 $rs = $mysqli->query($str_sql);
 
 // 結果セットの各レコードを順次，連想配列に格納する
 while($arr_record = $rs->fetch_assoc())
 {
 
  // 連想配列のキー値をフィールド名に，
  // 値をフィールド値として取り出す
  foreach($arr_record as $field_name => $field_value)
  {
   // フィールド名とフィールド値を表示
   print "[{$field_name}] = {$field_value}<br>\n" ;
  }
  print "<br>\n";
 }
 
 
 // データベースサーバの切断
 $mysqli->close();
 
?>
</body>
</html>