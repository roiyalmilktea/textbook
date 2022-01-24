<html>
<head>
<title>operand2.php</title>
</head>
<body>
<?php
// 加算子と減算子
 $a = 5;
 print ++$a . " ";         // 1を加算した後，出力する
 print "$a<br>";
 $a = 5;
 print $a++ . " ";         // 出力した後，１を加算する
 print "$a<br>";
 $a = 5;
 print --$a . " ";         // 1を減算した後，出力する
 print "$a<br>";
 $a = 5;
 print $a-- . " ";         // 出力した後，１を減算する
 print "$a<br>";
?>
</body>
</html>