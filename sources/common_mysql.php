<?php
// インクルードファイル(common_mysql.php)
// MySQL関連のユーザ定義関数
// by T.YAMADA  2006-09-14

// ----------------------------------------------
// テーブルのフィールド名を配列に格納する関数の定義
function arr_fields_name($rs,&$arr_fields_name)
{
// $rs　　　　　　　 結果ID(R)
// $arr_fields_name　フィールド名を格納した添字配列(W)
// 戻り値　=　TRUE　 テーブルにフィールド名がある場合
//　　　　 =　FALSE　テーブルにフィールド名がない場合

   // フィールド名を格納する配列の初期化
   $arr_fields_name = array();

   // 結果セットの最初のレコードのフィールド名と値を連想配列に取得
   $arr_record = mysql_fetch_assoc($rs);

   // 結果セットのポインター（レコード位置）を最初に戻す
   mysql_data_seek($rs,0);

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
function show_databases($db)
{
   // データベースリストの取得
   $rs = mysql_list_dbs($db);

   // 結果セット内のレコード数の取得
   $num_rows = mysql_num_rows($rs);

   print "<table border=1 cellpadding=0 cellspacing=0>\n";
   print "<tr>\n";
   print    "<td align=center>Database</td>\n";
   print "</tr>\n";

   // 結果セット内のレコードを順次参照
   for($i = 0; $i < $num_rows; $i++)
   {
      // データベース名の取得
      $db_name = mysql_db_name($rs,$i);

      // データベース名の表示
      print "<tr>\n";
      print    "<td>{$db_name}</td>\n";
      print "</tr>\n";
   }

   print "</table>\n";
}

// ----------------------------------------------
// フィールド属性の一覧表示の関数の定義
function show_fields($db_name,$tbl_name,$db)
{
   // 指定されたデータベース、テーブル内のフィールドリストの取得
   $rs = mysql_list_fields($db_name,$tbl_name,$db);

   // 結果セット内のフィールド数の取得
   $num_rows = mysql_num_fields($rs);

   print "テーブル「{$tbl_name}」内のフィールド属性一覧\n";
   print "<table border=1 cellpadding=0 cellspacing=0>\n";
   print "<tr>\n";
   print    "<td align=center>フィールド名</td>\n";
   print    "<td align=center>データ型(長さ)</td>\n";
   print    "<td align=center>フラグ</td>\n";
   print "</tr>\n";

   // フィールドがある場合
   if($num_rows > 0)
   {
      // 結果セット内のレコードを順次参照
      for($i = 0; $i < $num_rows; $i++)
      {
         // フィールド名の取得
         $field_name = mysql_field_name($rs,$i);

         // データ型の取得
         $field_type = mysql_field_type($rs,$i);

         // フィールドの長さの取得
         $field_len = mysql_field_len($rs,$i);

         // フィールドのフラグの取得
         $field_flags = mysql_field_flags($rs,$i);
         
         // フラグがヌルなら半角スペースとする
         if($field_flags == '')
         {
            $field_flags='&nbsp;';
         }

         // フィールド属性の表示
         print "<tr>\n";
         print    "<td>{$field_name}</td>\n";
         print    "<td>{$field_name}({$field_len})</td>\n";
         print    "<td>{$field_flags}</td>\n";
         print "</tr>\n";
      }
   }

   // フィールドが無い場合
   else
   {
      print "<tr>\n";
      print    "<td>フィールドはありません</td>\n";
      print "</tr>\n";
   }
   print "</table>\n";

}

// -----------------------------------------------
// テーブルの全データの一覧表示関数の定義
function show_records($db_name,$tbl_name,$db)
{
// $db_name　　　　　データベース名(R)
// $tbl_name　　　　 テーブル名(R)
// $db　　　　　　　 接続ID(R)
// 戻り値　=　TRUE　 テーブルにフィールド名がある場合
//　　　　 =　FALSE　テーブルにフィールド名がない場合

   // SQL文の作成
   $str_sql = "SELECT * FROM {$tbl_name}";

   // SQL文の実行
   $rs = mysql_query($str_sql,$db);

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

      // 結果セットの各レコードを順次、連想記憶に格納する
      while($arr_record = mysql_fetch_assoc($rs))
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
   mysql_free_result($rs);

   return $result;
}

// -----------------------------------------------
// 結果セットの全データの一覧表示関数の定義
function show_rs($rs)
{
// $rs　　　　　　　 結果ID(R)
// 戻り値　=　TRUE　 結果セットにフィールド名がある場合
//　　　　 =　FALSE　結果セットにフィールド名がない場合

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

      // 結果セットの各レコードを順次、連想記憶に格納する
      while($arr_record = mysql_fetch_assoc($rs))
      {
         // 行の表示の開始
         print "<tr>\n";
  
         foreach($arr_record as $field_name => $field_value)
         {
            if($field_value == "")
            {
               $field_value = '&nbsp';
            }
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
function show_tables($db_name,$db)
{
   // 指定されたデータベース内のテーブルリストの取得
   $rs = mysql_list_tables($db_name,$db);

   // 結果セット内のレコード数の取得
   $num_rows = mysql_num_rows($rs);

   print "<table border=1 cellpadding=0 cellspacing=0>\n";
   print "<tr>\n";
   print    "<td align=center>Tables in {$db_name}</td>\n";
   print "</tr>\n";

   // テーブルがある場合
   if($num_rows > 0)
   {
      // 結果セット内のレコードを順次参照
      for($i = 0; $i < $num_rows; $i++)
      {
         // テーブル名の取得
         $table_name = mysql_table_name($rs,$i);

         // テーブル名の表示
         print "<tr>\n";
         print    "<td>{$table_name}</td>\n";
         print "</tr>\n";
      }
   }

   // テーブルが無い場合
   else
   {
      print "<tr>\n";
      print    "<td>テーブルはありません</td>\n";
      print "</tr>\n";
   }
   print "</table>\n";
}



// ----------------------------------------------
// テーブルの存在チェック関数の定義
function table_exists($db_name,$tbl_name,$db)
{
   // テーブルリストの取得
   $rs = mysql_list_tables($db_name,$db);

   // 結果セットの1レコード分を添え字配列として取得する
   while($arr_row = mysql_fetch_row($rs))
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
