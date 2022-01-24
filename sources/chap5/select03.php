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
 
 // データベースサーバへの接続
 $mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);

 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql);
 
 
 // 参照するテーブル
 $tbl_name = "tbl_shouhin_hyou";
 
 // SQL文の作成
 $str_sql = "SELECT * FROM {$tbl_name}";
 
 // SQL文の実行
 $rs = $mysqli->query($str_sql);
 
 // 表の表示の開始
 print "<table border=1 celpadding=0 cellspacing=0>\n";
 
 // テーブルのフィールド名の取得
 // 指定されたデータベース，テーブル内のフィールドリストの取得
 $rs2 = $mysqli->query("Show columns from {$tbl_name}");
 
 // 結果セット内のフィールド数の取得
 $num_rows = $rs2->field_count;
 
 // フィールドがある場合
 if($num_rows > 0)
 {
  // 表のヘッダー部（フィールド名）の表示開始
  print "<tr>\n";
 
  // 結果セット内のレコードを順次参照
  while ($arr_record = $rs->fetch_field())
  {
   // フィールド名の取得
   $field_name = $arr_record->name;
 
   // フィールド名をセル内に表示
   print "<td align=center>{$field_name}</td>\n";
  }
  // 表のヘッダー部の表示終了
  print "</tr>\n";
 
  // 結果セットの各レコードを順次，連想記憶に格納する
  while($arr_record = $rs->fetch_assoc())
  {
   // 行の表示の開始
   print "<tr>\n";
 
   // 連想配列のキー値をフィールド名に，
   // 値をフィールド値として取り出す
   foreach($arr_record as $field_name => $field_value)
   {
    // フィールド値をセル内に表示
    print "<td>{$field_value}</td>\n" ;
   }    
   // 行の表示の終わり
   print "</tr>\n";
  }
 }
 // 表の表示の終了
 print "</table>\n";
 
 // データベースサーバの切断
 $mysqli->close();
 
?>
</body>
</html>