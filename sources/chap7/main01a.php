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
 $str_name   = $_POST['name'];
 $str_title  = $_POST['title'];
 $str_message = $_POST['message'];

 // 受信データの表示（仮）
 print "  氏名：[{$str_name}]<br>\n";
 print "タイトル：[{$str_title}]<br>\n";
 print "  記事：[{$str_message}]<br>\n";

}
?>
BBS1<br>
<form method="post" action="main01a.php">
  氏名<input name="name" size="30"><br>
タイトル<input name="title" size="60"><br>
  記事<textarea name="message" rows="5" cols="60"></textarea><br>
    <input type=submit name="command" value="送信"><br>
</form>
</body>
</html>