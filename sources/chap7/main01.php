<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" >
<title>BBS1</title>
</head>
<body>
<?php

 // データの受信
 $str_name   = $_POST['name'];
 $str_title  = $_POST['title'];
 $str_message = $_POST['message'];

 // 受信データの表示（仮）
 print "  氏名：[{$str_name}]<br>\n";
 print "タイトル：[{$str_title}]<br>\n";
 print "  記事：[{$str_message}]<br>\n";


?>
</body>
</html>