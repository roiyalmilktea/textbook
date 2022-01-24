<?php
include "common.php";
include "common_bbs2c.php";
define(THIS_FILE,"query03.php");
$str_charset = "UTF-8";
// ページサイズ
$page_size = 5;
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" >
<title>BBS1</title>
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
<a href="main02e.php">記事入力</a> ｜ 
<a href="main02e.php?page=all">全記事表示</a><br><br>

<!-- 検索キーワード入力部の表示 -->
<form action="query.php" method="post">
<input type="text" name="keyword">
<input type="submit" name="command" value="検索">
</form>
</p>
<?php

 // ページ番号を受信した場合
 if($_GET['page'] > 0)
 {
  // ページ番号
  $page = $_GET['page'];
  // SQL文
  $str_sql = $_GET['sql'];
  // URLエンコードしたデータのデコード
  // $str_sql = rawurldecode($str_sql);
  // 文字列をアンエスケープ
  $str_sql = stripslashes($str_sql);
  disp_var(1,$str_sql,'$str_sql');
  // ページ単位表示
  page_disp($str_sql,$page,$page_size,$db);

 }
 // 「検索」の場合
 elseif($_POST['command'] == "検索")
 {
  // キーワードの受信
  $str_keyword = $_POST['keyword'];

  // HTMLエンティティの変換
  $str_keyword = tag_entity_input($str_keyword,$str_charset);

  // 文字列の前後の半角スペースを削除し，半角カタカナを全角カタカナに変換
  $str_keyword = input_str_convert($str_keyword);

  // キーワードが「空」でないかどうかチェック
  if($str_keyword != "")
  {
   // SQL文のためのエスケープ処理 
   $str_keyword = $mysqli->real_escape_string($str_keyword);

   // 部分一致検索(最後に「;」をつけないこと）
   $str_sql = "select * from tbl_bbs2"
        . " where message like '%{$str_keyword}%'"
        . " order by message_id desc";
 
   // 第１ページ目の設定
   $page = 1;

   // ページ単位表示
   page_disp($str_sql,$page,$page_size,$mysqli);
   
   $mysqli->close();
  }
  else
  {
   $str_error_message = "キーワードを入力してください";
   print "<p align=center>";
   print "<font style='color:red'>{$str_error_message}</font><br>\n";
   print "</p>";
  }
 }
 print "<p class='ac'>"; 
?>
</body>
</html>