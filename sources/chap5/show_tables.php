<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>show_tables.php</title>
</head>
<body>
<?php
 
 require_once('./Connections/localhost.php');
 
$mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
    
 // テーブルの一覧表示の関数呼び出し（ユーザ定義関数）
 show_tables($mysqli,$db_name);
 
 // データベースサーバの切断
 $mysqli->close();
 
// ----------------------------------------------
// テーブルの一覧表示の関数の定義
function show_tables($mysqli,$db_name)
{
 // 指定されたデータベース内のテーブルリストの取得
 $rs = $mysqli->query("show tables");
 
 // 結果セット内のレコード数の取得
 $num_rows = $rs->num_rows;
 
 print "<table border=1 cellpadding=0 cellspacing=0>\n";
 print "<tr>\n";
 print "<td align=center>Tables in {$db_name}</td>\n";
 print "</tr>\n";
 
 // テーブルがある場合
 if($num_rows > 0)
 {
      // 結果セット内のレコードを順次参照
     while ($row_rs = $rs->fetch_assoc()){  
       // テーブル名の表示
       print "<tr>\n";
       print "<td>".$row_rs['Tables_in_'. $db_name . '']."</td>\n";
       print "</tr>\n";
     }
 }
 // テーブルが無い場合
 else
 {
  print "<tr>\n";
  print "<td>テーブルはありません</td>\n";
  print "</tr>\n";
 }
 print "</table>\n";
 
 // 結果セットの解放
 mysqli_free_result($rs);
}
?>
</body>
</html>