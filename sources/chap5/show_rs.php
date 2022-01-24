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
 
 // テーブルの全レコードの一覧表示
 print "テーブル「{$tbl_name}」のレコード一覧<br>\n";
 show_rs($rs);
 
 // 結果セットの解放
 mysqli_free_result($rs);
 
 // データベースサーバの切断
 $mysqli->close();
 
// -----------------------------------------------
// 結果セットの全データの一覧表示関数の定義
//function show_rs($rs)
//{
//// $rs     結果セット(R)
//// 戻り値 = TRUE  結果セットにフィールド名がある場合
////      = FALSE 結果セットにフィールド名がない場合
// 
// // フィールドがある場合
// if(arr_fields_name($rs,$arr_fields_name))
// {
//  // 表の表示の開始
//  print "<table border=1 celpadding=0 cellspacing=0>\n";
// 
//  // 表のヘッダー部（フィールド名）の表示開始
//  print "<tr>\n";
// 
//  // 配列の値を順次参照
//  foreach($arr_fields_name as $field_name)
//  {
//   // フィールド名の表示
//   print "<td align=center>{$field_name}</td>\n";
//  }
//  // 表のヘッダー部の表示終了
//  print "</tr>\n";
// 
//  // 結果セットの各レコードを順次，連想記憶に格納する
//  while($arr_record = $rs->fetch_assoc())
//  {
//   // 行の表示の開始
//   print "<tr>\n";
// 
//   foreach($arr_record as $field_name => $field_value)
//   {
//    // フィールド値をセル内に表示
//    print "<td>{$field_value}</td>\n" ;
//   }
//   // 行の表示の終わり
//   print "</tr>\n";
//  }
//  // 表の表示の終了
//  print "</table>\n";
// 
//  $result = TRUE;
// }
// 
// // フィールドがない場合
// else
// {
//  $result = FALSE;
// }
// return $result;
//}
// 
//// ----------------------------------------------
//// テーブルのフィールド名を配列に格納する関数の定義
//function arr_fields_name($rs,&$arr_fields_name)
//{
//// $rs        結果ID(R)
//// $arr_fields_name フィールド名を格納した添字配列(W)
//// 戻り値 = TRUE  テーブルにフィールド名がある場合
////     = FALSE テーブルにフィールド名がない場合
// 
// // フィールド名を格納する配列の初期化
// $arr_fields_name = array();
// 
// // 結果セットの最初のレコードのフィールド名と値を連想配列に取得
// $arr_record = $rs->fetch_assoc();
// 
// // 結果セットのポインター（レコード位置）を最初に戻す
// mysqli_data_seek($rs,0);
// 
// // フィールドがある場合
// if(is_array($arr_record))
// {
//  $arr_fields_name = array_keys($arr_record);
//  $result = TRUE;
// }
// 
// // フィールドがない場合
// else
// {
//  $result = FALSE;
// }
// return $result;
//}
?>
</body>
</html>