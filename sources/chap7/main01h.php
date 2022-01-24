<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" >
<title>BBS1</title>
</head>
<body>
<?php
require_once('./Connections/localhost.php');
// 「送信」の場合
if(isset($_POST['command'])&&$_POST['command'] == "送信")
{

 // 受信データが「空」でないかどうかチェック
 $str_error_message = data_check($str_name,$str_title,$str_message);

 if($str_error_message == "")
 {

  // 改行コードを改行タグに変換
  $str_message = preg_replace( "/(\r\n|\r|\n)/", "<br />", $str_message);

  // 現在日時の取得
  $str_date = date("Y-m-d H:i:s",time());

  // 「message_id」の生成
  // データベースへの接続
 $mysqli = new mysqli($hostname, $username, $password, $database);
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql); 

  // tbl_bbs1テーブルのmessage_idの最大値の取得
  $str_sql = "select max(message_id) as max_id from tbl_bbs1;";
  $rs = $mysqli->query($str_sql,$db);

  $arr_record = array();
  $arr_record = $rs->fetch_assoc();
  $max_id = $arr_record['max_id'];

  if($max_id > 0)
  {
   $new_id = $max_id + 1;
  }
  else
  {
   $new_id = 1;
  }

  // データのテーブルへの保存
  $str_sql = "insert into tbl_bbs1 "
       . "(message_id,name,title,message,date)"
       . "values("
       . $new_id. ",'" . $str_name . "','" . $str_title
       . "','" . $str_message . "','" . $str_date . "');";

  //print $str_sql;
  $mysqli->query($str_sql);

  // データのリセット
  $new_id = "";
  $str_name = "";
  $str_title = "";
  $str_message = "";
  $str_date = "";

  // テーブルのデータの一覧取得
  $str_sql = "select * from tbl_bbs1 order by message_id desc;";

  $rs = $mysqli->query($str_sql);

  // データの表示（仮）
  print "<p align=center>";

  while($arr_record = $rs->fetch_assoc())
  {
   // 記事データの配列への格納
   $arr_message = array();

   $arr_message['id']     = $arr_record['message_id'];
   $arr_message['name']   = $arr_record['name'];
   $arr_message['title']    = $arr_record['title'];
   $arr_message['message'] = $arr_record['message'];
   $arr_message['date']    = $arr_record['date'];

   // 1個の記事本文の表示
   message_disp($arr_message);

  }
  print "</p>";

  //結果セットを破棄し，接続を閉じる
  mysqli_free_result($rs);
  $db = $mysqli->close();
 }
 else
 {
  print "<p align=center>";
  print "<font style='color:red'>{$str_error_message}</font><br>\n";
  print "</p>";
 }
}

print "<p align=center>";

// 入力フォームの表示
input_form_disp($str_name,$str_title,$str_message);

print "</p>";
?>
</body>
</html>
<?php
// ユーザ定義関数
// ----------------------------------------------
// 受信データのチェック
function data_check(&$str_name,&$str_title,&$str_message)
{
/*
$str_name   ：投稿者氏名
$str_title    ：記事タイトル
$str_message ：記事本文
*/
 // データの受信
 $str_name   = $_POST['name'];
 $str_title    = $_POST['title'];
 $str_message = $_POST['message'];

 // 改行コードを改行タグに変換
 $str_message = preg_replace( "/(\r\n|\r|\n)/", "<br />", $str_message);

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
$str_name   ：投稿者氏名
$str_title    ：記事タイトル
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
$arr_message['id']     ：記事番号
$arr_message['name']   ：投稿者氏名
$arr_message['title']    ：記事タイトル
$arr_message['message'] ：記事本文
$arr_message['date']    ：投稿日時
*/
?>
 <table border="1" cellpadding="3" cellspacing="0" width="600">
 <tr>
  <td>No.<?=$arr_message['id']?> <?=$arr_message['title']?>
    ［<?=$arr_message['name']?>］ <?=$arr_message['date']?></td>
 </tr>
 <tr>
  <td><?=$arr_message['message']?></td>
 </tr>
 </table>
<?php
}
?>