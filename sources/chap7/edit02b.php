<?php
include "system02b.php";
include "common.php";
const THIS_FILE = EDIT_FILE;
include COMMON_BBS_FILE;
$str_charset = "UTF-8";
// ページサイズ
$page_size = 5;
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" >
<title>BBS2</title>
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="common.css">
</head>
<body class="b_ffff99">
<?php
 // データベースへの接続と選択
 require_once('./Connections/localhost.php');
  //var_dump($_post);
 $mysqli = new mysqli($hostname, $username, $password, $database);
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql);
?>
<!-- 「記事入力」，「全記事表示」のハイパーリンクの表示 -->
<p class="ac">
<a href="<?=MAIN_FILE?>">記事入力</a> ｜ 
<a href="<?=MAIN_FILE?>?page=all">全記事表示</a><br><br>
</p>
<?php
 // 「削除」リンクをクリックした場合
 if(isset($_GET['command'])&&$_GET['command'] == "del")
 {
  // 記事番号の受信
  $message_id = $_GET['id'];

  if($message_id > 0)
  {
   // 当該記事の検索
   $str_sql = "select * from tbl_bbs2"
        . " where message_id = {$message_id};";
   $rs = $mysqli->query($str_sql);

   if($rs->num_rows === 1)
   {
    $arr_record = $rs->fetch_assoc();

    // 記事データの配列への格納
    $arr_message = array();
    $arr_message['id']    = $arr_record['message_id'];
    $arr_message['name']   = $arr_record['name'];
    $arr_message['title']  = $arr_record['title'];
    $arr_message['message'] = $arr_record['message'];
    $arr_message['date']   = $arr_record['date'];
    $arr_message['url']   = $arr_record['url'];

    print "<p class='ac'>";
    print "パスワードを記入し，「削除」ボタンをクリックしてください<br>\n";
    // 1個の記事本文の表示
    message_show($arr_message);

    $message_id = $arr_message['id'];
    print "<form action='".THIS_FILE."' method='post'>\n";
    print "パスワード<input type='password' name='pwd'>\n";
    print "<input type='hidden' name='id' value='{$message_id}'>\n";
    print "<input type='submit' name='command' value='削除'>\n";
    print "<input type='submit' name='command' value='キャンセル'>\n";
    print "</form>\n";
    print "</p>\n";
    print "<br>\n";

   }
   mysqli_free_result($rs);
    $mysqli->close(); 
  }
 }
  elseif(isset($_POST['command'])&&$_POST['command'] == "削除")
 {
  // データの受信
  $message_id = $_POST['id'];
  $str_pwd   = $_POST['pwd'];

  $str_pwd  = trim($str_pwd);
  print "<p class='ac'>\n";
  if(preg_match(MATCH_PWD,$str_pwd))
  {
   // パスワードの暗号化
   $enc_pwd = "";
   if($str_pwd != "")
   { 
    $enc_pwd = crypt($str_pwd,SALT);
   } 
   // 削除用SQL文
   $str_sql = "delete from tbl_bbs2 "
        . "where message_id = {$message_id} and pwd = '{$enc_pwd}';";

   $rs = $mysqli->query($str_sql);
   // 削除されたレコード数の取得
   $del_rows = $mysqli->affected_rows;

   if($del_rows > 0)
   {
    print "記事を削除しました．<br><br>\n";
   }
   else
   {
    print "記事は削除できませんでした．<br><br>\n";
    print "<input type='button' value='戻る' "
      . "onclick='history.back()'><br>\n";
   }
  }
  else
  {
   print "記事は削除できませんでした．<br><br>\n";
   print "<input type='button' value='戻る' "
         . "onClick='history.back()'><br>\n";
  }
  print "</p>\n";
 }
 
 
?>