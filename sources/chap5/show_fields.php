<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>show_fields.php</title>
</head>
<body>
<?php
 
 require_once('./Connections/localhost.php');
 
$mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);
    
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 // テーブルの一覧表示の関数呼び出し（ユーザ定義関数）
 show_fields($db_name,$tb_name, $mysqli);
 
 // データベースサーバの切断
 $mysqli->close();  
 
// ----------------------------------------------
// フィールド属性の一覧表示の関数の定義
function show_fields($db_name,$tbl_name,$mysqli)
{
 // 指定されたデータベース，テーブル内のフィールドリストの取得
 $sql_query = "Show columns from {$tbl_name}";
 $rs = $mysqli->query($sql_query);
 
 // 結果セット内のレコード数の取得
 $num_rows = $rs->num_rows;
 
 print "テーブル「{$tbl_name}」内のフィールド属性一覧\n";
 print "<table border=1 cellpadding=0 cellspacing=0>\n";
 print "<tr>\n";
 print "<td align=center>フィールド名</td>\n";
 print "<td align=center>データ型(長さ)</td>\n";
 print "<td align=center>フラグ</td>\n";
 print "</tr>\n";
 
 // フィールドがある場合
 if($num_rows > 0)
 {

  // 結果セット内のレコードを順次参照
      while ($row_rs = $rs->fetch_assoc())
      {
       // フィールド名の取得
       $field_name = $row_rs['Field'];
     
       // データ型の取得
       $field_type = $row_rs['Type'];
     
       // フィールドのフラグの取得
       $field_flags = $row_rs['Extra'];
     
     
       // フラグがヌルなら半角スペースとする
       if($field_flags == '')
       {
        $field_flags=' ';
       }
     
       // フィールド属性の表示
       print "<tr>\n";
       print "<td>{$field_name}</td>\n";
       print "<td>{$field_type}</td>\n";
       print "<td>{$field_flags}</td>\n";
       print "</tr>\n";
      }
 }
 
 // フィールドが無い場合
 else
 {
  print "<tr>\n";
  print "<td>フィールドはありません</td>\n";
  print "</tr>\n";
 }
 print "</table>\n";
 
 // 結果セットの解放
 mysqli_free_result($rs);
}
 
?>
</body>
</html>