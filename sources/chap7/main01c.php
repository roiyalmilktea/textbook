<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" >
<title>BBS1</title>
</head>
<body>
<?php

// 「送信」の場合
if(isset($_POST['command'])&&$_POST['command'] == "送信")
{
 // データの受信
 $str_name  = $_POST['name'];
 $str_title  = $_POST['title'];
 $str_message = $_POST['message'];

 // 改行コードを改行タグに変換
 $str_message 
   = preg_replace( "/(\r\n|\r|\n)/", "<br />", $str_message);

 // 受信データの表示（仮）
?>
 <p align=center>
 <table border="1" cellpadding="3" cellspacing="0">
 <tr>
  <td>氏名</td><td><?=$str_name?></td>
 </tr>
 <tr>
  <td>タイトル</td><td><?=$str_title?></td>
 </tr>
 <tr>
  <td>記事</td><td><?=$str_message?></td>
 </tr>
 </table>
</p>
<?php
}
?>
<p align=center>
<table border="0">
<form method="post">
<tr>
 <td> </td><td>BBS1</td>
</tr>
<tr>
 <td>氏名</td><td><input name="name" size="30"></td>
</tr>
<tr>
 <td>タイトル</td><td><input name="title" size="60"></td>
</tr>
<tr>
 <td>記事</td>
 <td><textarea name="message" rows="5" cols="60"></textarea></td>
</tr>
<tr>
 <td> </td><td><input type=submit name="command" value="送信"></td>
</tr>
</form>
</table>
</p>
</body>
</html>