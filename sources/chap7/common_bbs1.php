<?php
// ユーザ定義関数
// ----------------------------------------------
// 受信データのチェック
function data_check(&$str_name,&$str_title,&$str_message)
{
/*
$str_name ：投稿者氏名
$str_title ：記事タイトル
$str_message ：記事本文
*/
 global $str_charset;
  // データの受信
  $str_name   = $_POST['name'];
  $str_title    = $_POST['title'];
  $str_message = $_POST['message'];
  // セキュリティ対策等処理
  $str_name   = tag_entity_input($str_name,$str_charset);
  $str_title    = tag_entity_input($str_title,$str_charset);
  $str_message = tag_entity_input($str_message,$str_charset);
  // 文字列の前後の半角スペースを削除し，半角カタカナを全角カタカナに変換
  $str_name   = input_str_convert($str_name);
  $str_title    = input_str_convert($str_title);
  $str_message = input_str_convert($str_message);
  // 文字列が空かいなかのチェック
  if($str_name == "")
  {
   $str = "氏名を記入してください";
  }
  elseif($str_title == "")
  {
   $str = "タイトルを記入してください";
  }
  elseif($str_message == "")
  {
   $str = "本文を記入してください";
  }
  return $str;
}

// ----------------------------------------------
// 入力フォームの表示
function input_form_disp(&$str_name,&$str_title,&$str_message)
{
/*
$str_name ：投稿者氏名
$str_title ：記事タイトル
$str_message ：記事本文
*/
  // 改行タグの改行コードへの変換
  $str_message = preg_replace( "/(<br>|<br \/>)/", "\n", $str_message);
?>
 <table border="0">
 <form method="post">
 <tr>
  <td> </td><td>BBS1</td>
 </tr>
 <tr>
  <td>氏名</td><td><input name="name" size="60"
                  value="<?=$str_name?>"></td>
 </tr>
 <tr>
  <td>タイトル</td><td><input name="title" size="60"
                    value="<?=$str_title?>"></td>
 </tr>
 <tr>
  <td>記事</td>
  <td><textarea name="message" 
           rows="5" cols="60"><?=$str_message?></textarea></td>
 </tr>
 <tr>
  <td> </td><td><input type=submit name="command" value="送信"></td>
 </tr>
 </form>
 </table>
<?php
}

// ----------------------------------------------
// 入力文字列の整形処理
function input_str_convert($str)
{
 if($str != "")
  {
   // 文字列の前後の半角スペースを削除
   $str = trim($str);
   // 半角カタカナを全角カタカナに変換
   // V: 濁点付きの文字を１文字に変換
   // K: 半角カタカナを全角カタカナに変換
   $str = mb_convert_kana($str,'KV');
  }
  return $str;
}

// -----------------------------------------------
// 1個の記事本文の表示
function message_disp(&$arr_message)
{
/*
$arr_message['id'] ：記事番号
$arr_message['name'] ：投稿者氏名
$arr_message['title'] ：記事タイトル
$arr_message['message'] ：記事本文
$arr_message['date'] ：投稿日時
*/

?>
<table class="bd_w1 bd_solid bd_b
    padding3 bd_spacing0 bd_collapse w600">
<tr class="b_dcdcdc xs">
 <td>No.<?=$arr_message['id']?> <?=$arr_message['title']?>
    <span class="fbold">［<?=$arr_message['name']?>］ </span>
    <span class="696969"><?=$arr_message['date']?></span></td>
</tr>
<tr class="b_w xs">
 <td><?=$arr_message['message']?></td>
</tr>
</table>
<?php
}

// ----------------------------------------------
// ページ単位表示
function page_disp($str_sql,$page,$page_size,$mysqli)
{
/*
$str_sql SQL文
$page ページ番号
$page_size ページサイズ
$db データベース接続リソース
*/
  if($str_sql != "" && $page > 0)
  {   
   // limit句なしでSQL文の実行
   $rs0 = $mysqli->query($str_sql . ";");
   // 全レコード数
   $total_record = $rs0->num_rows;
   // 全ページ数
   $total_page = ceil($total_record / $page_size);
   
  if($page > 0 && $page <= $total_page)
  {
    // ページ数の値が正しい場合
   // オフセットの設定
    $offset = ($page - 1) * $page_size;
    // SQL文にlimit句追加
    $str_sql_limit = $str_sql . " limit " 
             . $offset ."," . $page_size . ";";
    // 指定ページのみ抽出
    $rs = $mysqli->query($str_sql_limit);

   // ページの表示
    print "<p class='ac'>";
    // ページナビゲータの表示
    // ページナビゲータの表示
    page_navigater_disp($str_sql,$page,$total_page,$page_size);
  
    // ページ内全記事の表示
    while($arr_record = $rs->fetch_assoc())
    {
     // 記事データの配列への格納
     $arr_message = array();
     $arr_message['id'] = $arr_record['message_id'];
     $arr_message['name'] = $arr_record['name'];
     $arr_message['title'] = $arr_record['title'];
     $arr_message['message'] = $arr_record['message'];
     $arr_message['date'] = $arr_record['date'];
  
    // 1個の記事本文の表示
     message_disp($arr_message);
     print "<br>\n";
    }
    
   // ページナビゲータの表示
     page_navigater_disp($str_sql,$page,$total_page,$page_size);
     print "</p>";
  
    //結果セットを破棄し，接続を閉じる
    mysqli_free_result($rs);
   }
   //結果セットを破棄し，接続を閉じる
   mysqli_free_result($rs0);
  }
}

// -----------------------------------------------
//
function page_navigater_disp($str_sql,$page,$total_page,$page_size)
{

 // URLエンコード
  $str_sql_encoded = rawurlencode($str_sql);
  // URL文字列生成
  $str_url = THIS_FILE . "?sql=" . $str_sql_encoded
           . "&page=" ;
  // ページナビゲータ表示
  print "<table class='bd_w0'>\n";
  print "<tr>\n";
  print "<td class='al w250'>";
  
 if($page > 1)
  {
   // URL文字列に前のページ番号追加
   $str_url_before = $str_url . ($page - 1);

   print "[<a href=" . $str_url_before . ">前の" 
         . $page_size . "ページ</a>]\n";
  }
  else
  {
   print "<span class='silver'>[前の{$page_size}ページ]</span>";
  }
  
 print "</td>\n";
  print "<td class='ac w100'>\n";
  // 「現在ページ／全ページ数」の表示
  print $page . "／" . $total_page . "    ";
  print "</td>\n";
  print "<td class='ar w250'>\n";

 if($page < $total_page)
  {
   // URL文字列に次ののページ番号追加
   $str_url_next = $str_url . ($page + 1);
   
   print "[<a href=" . $str_url_next . ">次の"    
       . $page_size . "ページ</a>]\n";
  }
  else
  {
   print "<span class='silver'>[次の{$page_size}ページ]</span>";
  }
  print "</td>\n";
  print "</tr>\n";
  print "</table>\n";
  }
?>