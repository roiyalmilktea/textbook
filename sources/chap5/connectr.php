<html>
<head>
<title>connectr.php</title>
</head>
<body>
<?php
  
  require_once('./Connections/localhost.php');
  
 print "データベースへの接続テスト<br>";
  
 //データベースサーバへの接続
$mysqli = new mysqli($dbhost, $db_user, $db_passwd, $db_name);
  
  
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql);
  
 //SQL文の設定
 $str_sql = "select * from " . $tb_name;
  
 //SQL文の実行
 $rs = $mysqli->query($str_sql);
  
 //結果セット内の各レコードを順次参照し，連想配列に代入
 while($arr_item = $rs->fetch_assoc())
 {
  
  //レコード内の各フィールド名と値を順次参照
  foreach($arr_item as $key => $value)
  {
   //フィールド名と値を表示
   print "[{$key}] = {$value}<br>\n";
  }
  print "<br>\n";
 }
  
 //データベースサーバへの接続の切断
 $mysqli->close();
  
?>
</body>
</html>