<?php
include "system02e.php";
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

// 「返信」リンクをクリックした場合
if(isset($_GET['command'])&&$_GET['command'] == "response")
{
$status = "before";

// データの受信
$parent_id = $_GET['id'];
// 検索用SQL文
$str_sql = "select * from tbl_bbs2 "
. "where message_id = {$parent_id} ;";
$rs = $mysqli->query($str_sql);
// 検索されたレコード数の取得
$select_rows = $rs->num_rows;
if($select_rows > 0)
{
// 検索結果リソースの連想配列への格納
$arr_record = $rs->fetch_assoc();

// 記事データの変数への格納
$str_title = $arr_record['title'];
$str_message = $arr_record['message'];
$str_parent_mail_address = $arr_record['mail'];

// 記事返信画面の表示
//response_form_disp($status,$parent_id,$str_name,$str_title
//,$str_message,$str_url,$str_pwd);
$str_name = "";
$str_mail_address = "";
$str_pwd = "";
$str_url = "";
$mail_send = "";

    
response_form_disp($status,$parent_id,$str_name,$str_mail_address,
$str_title,$str_message,$str_url,$str_pwd,$str_parent_mail_address,$mail_send);

}
else
{
print "記事番号が間違っています．<br><br>\n";
print "<input type='button' value='戻る' "
. "onClick='history.back()'><br>\n";
}
}

// 「送信」の場合
elseif(isset($_POST['command'])&&$_POST['command'] == "送信")
{
$status = "after";
// 親記事番号の受信
$parent_id = $_POST['parent_id'];
$str_parent_mail_address = $_POST['parent_mail_address'];
$mail_send = $_POST['mail_send'];

// 受信データのチェック
$str_error_message = data_check($str_name,$str_title,$str_message
,$str_url,$str_pwd);
if($str_error_message == "")
{
// 現在日時の取得
$str_date = date("Y-m-d H:i:s",time());
// 「message_id」の生成
// tbl_bbs2テーブルのmessage_idの最大値の取得
$str_sql = "select max(message_id) as max_id from tbl_bbs2;";
$rs = $mysqli->query($str_sql);
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
// SQL文のためのエスケープ処理
$str_name = $mysqli->real_escape_string($str_name);
$str_title = $mysqli->real_escape_string($str_title);
$str_message = $mysqli->real_escape_string($str_message);

// パスワードの暗号化
disp_var(2,$str_pwd,'$str_pwd');
$enc_pwd = "";
if($str_pwd != "")
{
$enc_pwd = crypt($str_pwd,SALT);
}

// データのテーブルへの保存
$str_sql = "insert into tbl_bbs2 "
. "(message_id,name,mail,title,message,date,url,pwd,parent_id)"
. "values("
. $new_id. ",'" . $str_name . "','" . $str_mail_address ."','" . $str_title
. "','" . $str_message . "','" . $str_date 
. "','" . $str_url . "','" . $enc_pwd 
. "'," . $parent_id . ");";
if(!$mysqli->query($str_sql))
{
print "<br>ERROR_NO=" . $mysqli->errno() . ":"
. $mysqli->error() . "<br>}";
}

// メール送信
if(MAIL_SEND && $mail_send == "yes")
{
mb_language('Japanese');
$mail_to = $str_parent_mail_address;
$str_subject = $str_title;
$mail_from = "From: " . $str_mail_address;
// メール送信
mb_send_mail($mail_to,$str_subject,$str_message,$mail_from);
}

// データのリセット
$new_id = "";
$str_name = "";
$str_title = "";
$str_message = "";
$str_date = "";
$str_url = "";
$str_pwd = "";

// テーブルのデータの一覧取得（最後に「;」をつけない）
$str_sql = "select * from tbl_bbs2 order by message_id desc";

// 第１ページ目の設定
$page = 1;

// ページ単位表示
page_disp($str_sql,$page,$page_size,$mysqli);
}
else
{
print "<span class='red'>{$str_error_message}</span><br>\n";
// 記事返信画面の表示
response_form_disp($status,$parent_id,$str_name,$str_mail_address
,$str_title,$str_message,$str_url,$str_pwd
,$str_parent_mail_address,$mail_send);
}
}

 
?>