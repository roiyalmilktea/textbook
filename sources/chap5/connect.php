<html>
<head>
<title>connect.php</title>
</head>
<body>
<?php
 
 print "データベースへの接続テスト<br>";
 
 //データベースサーバ名の設定
 $db_host  = "localhost";
 
 //ユーザ名の設定
 $db_user  = "root";
 
 //パスワードの設定
 $db_passwd = "root";
    
 //データベース名の設定
 $db_name = "my_blog";
 
 $mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);
    
 //テーブル名の設定
 $tb_name = "tbl_shouhin_hyou";
 
 
 //クライアント文字コードの通知（文字化け防止）
 mysqli_set_charset($mysqli,"utf8");
 
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