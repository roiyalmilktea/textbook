<?php
include "common.php";
include "common_bbs1.php";
const THIS_FILE = "main01l.php";
$str_charset = "UTF-8";
// ページサイズ
$page_size = 5;
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" >
<title>BBS1:記事検索</title>
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="common.css">
</head>
<body class="b_ffff99">
<?php
 require_once('./Connections/localhost.php');
  //var_dump($_post);
  // データベースへの接続と選択
 $mysqli = new mysqli($hostname, $username, $password, $database);
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql); 
?>
<!-- 「記事入力」，「全記事表示」のハイパーリンクの表示 -->
<p class="ac">
<a href="main01l.php">記事入力</a> ｜ 
<a href="main01l.php?page=all">全記事表示</a><br><br>

<!-- 検索キーワード入力部の表示 -->
<form action="query.php" method="post">
<input type="text" name="keyword">
<input type="submit" name="command" value="検索">
</form>
</p><?php

 // 全記事表示（page=all）
 if(isset($_GET['page'])&&$_GET['page'] == 'all' && !isset($_POST['command']))
 {
  // テーブルのデータの一覧取得（最後に「;」をつけない）
  $str_sql = "select * from tbl_bbs1 order by message_id desc";

  // 第１ページ目の設定
  $page = 1;

  // ページ単位表示
  page_disp($str_sql,$page,$page_size,$mysqli);

  $db = $mysqli->close();
 }
 // ページ番号を受信した場合
 elseif(isset($_GET['page'])&&$_GET['page'] > 0)
 {
  // ページ番号
  $page = $_GET['page'];
  // SQL文
  $str_sql = $_GET['sql'];

  // ページ単位表示
  page_disp($str_sql,$page,$page_size,$mysqli);

 }
 // 「送信」の場合
 if(isset($_POST['command'])&&$_POST['command'] == "送信")
 {
  // 受信データが「空」でないかどうかチェック
  $str_error_message = data_check($str_name,$str_title,$str_message);
  disp_var(0,$str_message,'$str_message');
  if($str_error_message == "")
  {
   // 現在日時の取得
   $str_date = date("Y-m-d H:i:s",time());
   // 「message_id」の生成
   // tbl_bbs1テーブルのmessage_idの最大値の取得
   $str_sql = "select max(message_id) as max_id from tbl_bbs1;";
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

   $str_name = $mysqli->real_escape_string($str_name);
   $str_title = $mysqli->real_escape_string($str_title);
   $str_message = $mysqli->real_escape_string($str_message);

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

   // テーブルのデータの一覧取得（最後に「;」をつけない）
   $str_sql = "select * from tbl_bbs1 order by message_id desc";

   // 第１ページ目の設定
   $page = 1;

   // ページ単位表示
   page_disp($str_sql,$page,$page_size,$mysqli);

   $mysqli->close();
  }
  else
  {
   print "<p align=center>";
   print "<font style='color:red'>{$str_error_message}</font><br>\n";
   print "</p>";
  }
 }
 print "<p class='ac'>";

 // 入力フォームの表示
 input_form_disp($str_name,$str_title,$str_message);
 print "</p>";
?>
</body>
</html>