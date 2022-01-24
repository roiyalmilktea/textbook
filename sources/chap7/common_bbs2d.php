<?php
// ユーザ定義関数
// ----------------------------------------------
// 受信データのチェック
function data_check(&$str_name,&$str_title,&$str_message,&$str_url,&$str_pwd)
{
/*
$str_name ：投稿者氏名
$str_title ：記事タイトル
$str_message ：記事本文
$str_url ：関連URL
*/
    
$str = "";
    
 global $str_charset;
 disp_var(1,$str_charset,'$str_charset');
 // データの受信
 $str_name = $_POST['name'];
 $str_title = $_POST['title'];
 $str_message = $_POST['message'];
 $str_url = $_POST['url'];
 $str_pwd = $_POST['pwd'];

 $str_name = tag_entity_input($str_name,$str_charset);
 $str_title = tag_entity_input($str_title,$str_charset);
 $str_message = tag_entity_input($str_message,$str_charset);

 // 文字列の前後の半角スペースを削除し，半角カタカナを全角カタカナに変換
 $str_name = input_str_convert($str_name);
 $str_title = input_str_convert($str_title);
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
 elseif($str_url != "http://")
 {
  if(!preg_match(MATCH_URL,$str_url))
  {
   $str = "URLを正しく記入してください";
  }
 }
 elseif($str_url == "http://")
 {
  $str_url = "";
 }
 return $str;
}

// ----------------------------------------------
// 入力フォームの表示
function input_form_disp(&$str_name,&$str_title,&$str_message,&$str_url,&$str_pwd)
{
/*
$str_name  ：投稿者氏名
$str_title  ：記事タイトル
$str_message ：記事本文
$str_url  ：関連URL
$str_pwd    ：パスワード
*/
 // 改行タグの改行コードへの変換
 $str_message = tag_entity_form($str_message);
 
 // URL欄の初期値設定
 if($str_url == "")
 {
  $str_url = "http://";
 }
?>
<table border="0">
<form method="post" action='<?=THIS_FILE?>'>
<tr>
 <td> </td><td>BBS1</td>
</tr>
<tr>
 <td>氏名</td><td><input name="name" size="30"
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
 <td>URL</td><td><input name="url" size="60"
            value="<?=$str_url?>"></td>
</tr>
	<td>パスワード</td>
	<td><input type="password" name="pwd" size="8"
		class="hankaku" value="<?=$str_pwd?>"></td>
</tr>
<tr>
 <td> </td><td><input type=submit name="command" value="送信"></td>
</tr>
</form>
</table>
<?php
}

// ----------------------------------------------
// 返信フォームの表示
function response_form_disp($status,$parent_id,$str_name,$str_title
,$str_message,$str_url,$str_pwd)
{
/*
$parent_id ：親記事番号
$str_name ：投稿者氏名
$str_title ：記事タイトル
$str_message ：記事本文
$str_url ：関連URL
$str_pwd ：パスワード
*/
// 改行タグの改行コードへの変換
$str_message = tag_entity_form($str_message);

if($status == "before")
{
// タイトルの冒頭に「Re[n]:」を付加する
$str_title = re_counter($str_title);

// 記事本文の行頭に引用記号「> 」を挿入する
$arr_message = array();
$arr_message = explode("\n",$str_message);
$arr_message_new = array();
foreach($arr_message as $str_line)
{
$str_line = "&gt; " . $str_line;
array_push($arr_message_new,$str_line);
}
$str_message = implode("\n",$arr_message_new);
}

// URL欄の初期値設定
if($str_url == "")
{
$str_url = "http://";
}
?>
<table border="0">
<form method="post" action='<?=RESPONSE_FILE?>'>
<tr>
<td> </td><td>BBS1</td>
</tr>
<tr>
<td>氏名</td><td><input name="name" size="30"
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
<td>URL</td><td><input name="url" size="60"
value="<?=$str_url?>"></td>
</tr>
<tr>
<td>パスワード</td>
<td><input type="password" name="pwd" size="8"
class="hankaku" value="<?=$str_pwd?>">(半角英数字)</td>
</tr>
<tr>
<td> </td><td><input type=submit name="command" value="送信"></td>
</tr>
<input type="hidden" name="parent_id" value="<?=$parent_id?>">
</form>
</table>
<?php
}

// ----------------------------------------------
// タイトルの冒頭に返信レベルカウンター「Re[n]:」を付加する
function re_counter($str)
{
// 返信レベルカウンター用文字列の設定
$str_re1 = "Re[";
$str_re2 = "]:";
// 返信レベルカウンターのパターンマッチ
if(preg_match(MATCH_RE,$str,$arr))
{
// 返信レベルカウンターのレベル値を１だけ増分
$str_re_next = $str_re1 . ($arr[2] + 1) . $str_re2;
// 返信レベルカウンターの置換
$str = preg_replace(MATCH_RE,$str_re_next,$str);
}
else
// 返信レベルカウンターの文字列がない場合（最初の返信）
{
$str = $str_re1 . "1" . $str_re2 . $str;
}
return $str;
}

// ----------------------------------------------
// 更新モードでの記事の表示
	function update_form_disp(&$message_id,&$str_name,&$str_title,&$str_message
	,&$str_date,&$str_update,&$str_url,&$str_pwd)
	{
	/*
	$str_name ：投稿者氏名
	$str_title ：記事タイトル
	$str_message ：記事本文
	$str_url ：関連URL
	$str_pwd ：パスワード
	*/
	// 改行タグの改行コードへの変換
	$str_message = tag_entity_form($str_message);

	// URL欄の初期値設定
	if($str_url == "")
	{
		$str_url = "http://";
	}
?>
<table border="0">
<form method="post" action='<?=EDIT_FILE?>'>
<tr>
<td> </td><td>BBS1</td>
</tr>
<tr>
<td>記事番号</td><td><?=$message_id?></td>
</tr>
<tr>
<td>氏名</td><td><input name="name" size="30"
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
<td>URL</td><td><input name="url" size="60"
value="<?=$str_url?>"></td>
</tr>
<tr>
<td>パスワード</td>
<td><input type="password" name="pwd" size="8"
class="hankaku" value="<?=$str_pwd?>">(半角英数字)</td>
</tr>
<tr>
<td>投稿日</td><td><?=$str_date?></td>
</tr>
<tr>
<td class='xs'>前回更新日</td><td><?=$str_update?></td>
</tr>
<tr>
<td> </td>
<td><input type="submit" name="command" value="送信">
<input type="submit" name="command" value="キャンセル"></td>
</tr>
<input type="hidden" name="id" value="<?=$message_id?>">
<input type="hidden" name="date" value="<?=$str_date?>">
<input type="hidden" name="update" value="<?=$str_update?>">
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
	$arr_message['url'] ：関連URL
	*/
	 $str_url = $arr_message['url'];

	// 「削除」用URL
	$str_url_del = EDIT_FILE . "?id=" . $arr_message['id'] . "&command=del";

	// 「更新」用URL
	$str_url_update = EDIT_FILE . "?id=" . $arr_message['id']. "&command=update";

	// 「返信」用URL
	$str_url_response = RESPONSE_FILE . "?id=" . $arr_message['id']
	. "&command=response";
?>
<table class="bd_w1 bd_solid bd_b
padding3 bd_spacing0 bd_collapse w600">
<tr class="b_dcdcdc xs">
<td>No.<?=$arr_message['id']?> <?=$arr_message['title']?>
<span class="fbold">［<?=$arr_message['name']?>］ </span>
<span class="696969"><?=$arr_message['date']?></span></td>
<td class='ar'><a href="<?=$str_url_response?>">返信</a></td>
</tr>
<tr class="b_w xs">
<td colspan=2><?=$arr_message['message']?>
<?php
 if($str_url != "")
 {
?>
<br>URL: <a href="<?=$str_url?>"><?=$str_url?></a></td>
<?php
 }
?>
</tr>
</table>
<table class="bd_w0 w600">
<tr class="xs">
	<td class="ar">
		<a href="<?=$str_url_del?>">削除</a>
		<a href="<?=$str_url_update?>">更新</a></td>
	</td>
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
     $arr_message['url'] = $arr_record['url'];
  
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
  
  // -----------------------------------------------
// 1個の記事本文の表示（確認用）
function message_show(&$arr_message)
{
/*
$arr_message['id'] ：記事番号
$arr_message['name'] ：投稿者氏名
$arr_message['title'] ：記事タイトル
$arr_message['message'] ：記事本文
$arr_message['date'] ：投稿日時
$arr_message['url'] ：関連URL
*/
 $str_url = $arr_message['url'];

 $str_url_del = EDIT_FILE . "?id=" . $arr_message['id']
        . "&command=del";
?>
<table class="bd_w1 bd_solid bd_b
       padding3 bd_spacing0 bd_collapse w600">
<tr class="b_dcdcdc xs">
 <td>No.<?=$arr_message['id']?> <?=$arr_message['title']?>
   <span class="fbold">［<?=$arr_message['name']?>］ </span>
   <span class="696969"><?=$arr_message['date']?></span></td>
</tr>
<tr class="b_w xs">
 <td><?=$arr_message['message']?>
<?php
 if($str_url != "")
 {
?>
<br>URL: <a href="<?=$str_url?>"><?=$str_url?></a></td>
<?php
 }
?>
</tr>
</table>
<?php
}
  
?>