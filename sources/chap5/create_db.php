<?php
// インクルードファイルの読み込み
include "common_mysql.php";
 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>create_db.php</title>
</head>
<body>
<?php
 
 require_once('./Connections/localhost.php');
 
 // データベースサーバへの接続
$mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
  
 // テーブルの一覧表示の関数呼び出し（ユーザ定義関数）
 show_tables($mysqli,$db_name);
 
 // データベースの一覧表示
 show_databases($mysqli);
 print "<br>\n";
 
 // データベースの作成
 $db_name = 'db_test';
 $str_sql = "CREATE DATABASE {$db_name};";
 if($mysqli->query($str_sql))
 {
  print "データベース「{$db_name}」を作成しました．<br><br>\n";
 }
 else
 {
  exit('データベース作成失敗');
 }
 
 // データベースの一覧再表示
 show_databases($mysqli);
 
 // データベースの削除
 $str_sql = "DROP DATABASE {$db_name};";
 if($mysqli->query($str_sql))
 {
  print "データベース「{$db_name}」を削除しました．<br><br>\n";
 }
 else
 {
  exit('データベース削除失敗');
 }

 
 // データベースの一覧再々表示
 show_databases($mysqli);
 
 // データベースサーバの切断
 $mysqli->close();
 
?>
</body>
</html>