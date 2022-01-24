<?php
// インクルードファイルの読み込み
include "common_mysql.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>create_table.php</title>
</head>
<body>
<?php
 
  require_once('./Connections/localhost.php');
 
 // データベースサーバへの接続
$mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql);
 
 // テーブルの一覧表示
 show_tables($mysqli,$db_name);
 print "<br>\n";
 
 // テーブルが存在しない場合
 $tbl_name = "tbl_test";
 if(!table_exists($db_name,$tbl_name,$mysqli))
 {
 
  // テーブル作成用SQL文
  $str_sql = "CREATE TABLE {$tbl_name}"
      . "("
      . "shouhin_code CHAR(4),"
      . "shouhin_mei CHAR(16),"
      . "tanaka    INTEGER,"
      . "PRIMARY KEY(shouhin_code)"
      . ");";
  print '$str_sql= ' . "'{$str_sql}'<br><br>";
 
  // SQL文の実行
  $mysqli->query($str_sql);
  print "テーブル「{$tbl_name}」を作成しました．<br><br>\n";
 
  // テーブルの一覧表示
  show_tables($mysqli,$db_name);
  print "<br>\n";
 
  // フィールド属性の一覧表示
  show_fields($db_name,$tbl_name,$mysqli);
  print "<br>\n";
 }
 
 // テーブルが存在する場合
 else
 {
  print "テーブル「{$tbl_name}」は作成済みです．<br>\n";
 }
 
 // テーブルが存在する場合
 if(table_exists($db_name,$tbl_name,$mysqli))
 {
  // テーブル削除用SQL文
  $str_sql = "DROP TABLE {$tbl_name};";
 
  // SQL文の実行
  $mysqli->query($str_sql);
  print "テーブル「{$tbl_name}」を削除しました．<br><br>\n";
 
  // テーブルの一覧表示
  show_tables($mysqli,$db_name);
  print "<br>\n";
 }
 
 // テーブルが存在しない場合
 else
 {
  print "テーブル「{$tbl_name}」はありません．<br>\n";
 }
 
 // データベースサーバの切断
 $mysqli->close();
 
// ----------------------------------------------
// テーブルの存在チェック関数の定義
//function table_exists($db_name,$tbl_name,$mysqli)
//{
// // テーブルリストの取得
// $rs = $mysqli->query("show tables");
// // 結果セットの1レコード分を添え字配列として取得する
// while($arr_row = $rs->fetch_row())
// {
//  // 添え字配列内にテーブル名が存在する場合
//  if(in_array($tbl_name,$arr_row))
//  {
//   return true;
//  }
// }
// return false;
//}
?>
</body>
</html>