<?php
// インクルードファイル(common_mysql.php)
// MySQL関連のユーザ定義関数
// by T.YAMADA  2006-09-14

// ----------------------------------------------
// テーブルのフィールド名を配列に格納する関数の定義
function arr_fields_name($rs,&$arr_fields_name)
{
// $rs        結果ID(R)
// $arr_fields_name フィールド名を格納した添字配列(W)
// 戻り値 = TRUE  テーブルにフィールド名がある場合
//     = FALSE テーブルにフィールド名がない場合
 
 // フィールド名を格納する配列の初期化
 $arr_fields_name = array();
 
 // 結果セットの最初のレコードのフィールド名と値を連想配列に取得
 $arr_record = $rs->fetch_assoc();
 
 // 結果セットのポインター（レコード位置）を最初に戻す
 mysqli_data_seek($rs,0);
 
 // フィールドがある場合
 if(is_array($arr_record))
 {
  $arr_fields_name = array_keys($arr_record);
  $result = TRUE;
 }
 
 // フィールドがない場合
 else
 {
  $result = FALSE;
 }
 return $result;
}

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

// -----------------------------------------------
// テーブルの全データの一覧表示関数の定義
function show_records($db_name,$tbl_name,$mysqli)
{
// $db_name     データベース名(R)
// $tbl_name     テーブル名(R)
// $mysqli       接続ID(R)
// 戻り値 = TRUE  テーブルにフィールド名がある場合
//      = FALSE テーブルにフィールド名がない場合
 
 // SQL文の作成
 $str_sql = "SELECT * FROM {$tbl_name}";
 
 // SQL文の実行
 $rs = $mysqli->query($str_sql);
 
 // フィールドがある場合
 if(arr_fields_name($rs,$arr_fields_name))
 {
  // 表の表示の開始
  print "<table border=1 celpadding=0 cellspacing=0>\n";
 
  // 表のヘッダー部（フィールド名）の表示開始
  print "<tr>\n";
 
  // 配列の値を順次参照
  foreach($arr_fields_name as $field_name)
  {
   // フィールド名の表示
   print "<td align=center>{$field_name}</td>\n";
  }
  // 表のヘッダー部の表示終了
  print "</tr>\n";
 
  // 結果セットの各レコードを順次，連想記憶に格納する
  while($arr_record = $rs->fetch_assoc())
  {
   // 行の表示の開始
   print "<tr>\n";
 
   foreach($arr_record as $field_name => $field_value)
   {
    // フィールド値をセル内に表示
    print "<td>{$field_value}</td>\n" ;
   }
   // 行の表示の終わり
   print "</tr>\n";
  }
  // 表の表示の終了
  print "</table>\n";
 
  $result = TRUE;
 }
 
 // フィールドがない場合
 else
 {
  $result = FALSE;
 }
 // 結果セットの解放
 mysqli_free_result($rs);
 
 return $result;
}

// -----------------------------------------------
// 結果セットの全データの一覧表示関数の定義
function show_rs($rs)
{
// $rs     結果セット(R)
// 戻り値 = TRUE  結果セットにフィールド名がある場合
//      = FALSE 結果セットにフィールド名がない場合
 
 // フィールドがある場合
 if(arr_fields_name($rs,$arr_fields_name))
 {
  // 表の表示の開始
  print "<table border=1 celpadding=0 cellspacing=0>\n";
 
  // 表のヘッダー部（フィールド名）の表示開始
  print "<tr>\n";
 
  // 配列の値を順次参照
  foreach($arr_fields_name as $field_name)
  {
   // フィールド名の表示
   print "<td align=center>{$field_name}</td>\n";
  }
  // 表のヘッダー部の表示終了
  print "</tr>\n";
 
  // 結果セットの各レコードを順次，連想記憶に格納する
  while($arr_record = $rs->fetch_assoc())
  {
   // 行の表示の開始
   print "<tr>\n";
 
   foreach($arr_record as $field_name => $field_value)
   {
    // フィールド値をセル内に表示
    print "<td>{$field_value}</td>\n" ;
   }
   // 行の表示の終わり
   print "</tr>\n";
  }
  // 表の表示の終了
  print "</table>\n";
 
  $result = TRUE;
 }
 
 // フィールドがない場合
 else
 {
  $result = FALSE;
 }
 return $result;
}
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


// ----------------------------------------------
// テーブルの存在チェック関数の定義
function table_exists($db_name,$tbl_name,$mysqli)
{
 // テーブルリストの取得
 $rs = $mysqli->query("show tables");
 // 結果セットの1レコード分を添え字配列として取得する
 while($arr_row = $rs->fetch_row())
 {
  // 添え字配列内にテーブル名が存在する場合
  if(in_array($tbl_name,$arr_row))
  {
   return true;
  }
 }
 return false;
}


?>
