<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>show_databases.php</title>
</head>
<body>
<?php
 
 require_once('./Connections/localhost.php');

$mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
 // データベースの一覧表示の関数呼び出し（ユーザ定義関数）
 show_databases($mysqli);
 
 // データベースサーバの切断
 $mysqli->close();
 
// ----------------------------------------------
// データベースの一覧表示の関数の定義
function show_databases($mysqli)
{
 // データベースリストの取得]
 $rs = $mysqli->query("show databases");
 
 // 結果セット内のレコード数の取得
 $num_rows = $rs->num_rows;
 
 print "<table border=1 cellpadding=0 cellspacing=0>\n";
 print "<tr>\n";
 print "<td align=center>Database</td>\n";
 print "</tr>\n";
 
 // 結果セット内のレコードを順次参照
 while ($row_rs = $rs->fetch_assoc())
 {
  // データベース名の取得
  $db_name = $row_rs['Database'];
 
  // データベース名の表示
  print "<tr>\n";
  print "<td>{$db_name}</td>\n";
  print "</tr>\n";
 }
 
 print "</table>\n";
 
 // 結果セットの解放
 mysqli_free_result($rs);
}
?>
</body>
</html>