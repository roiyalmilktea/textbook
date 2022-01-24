<html>
<head>
<title>error_cont.php</title>
</head>
<body>
<?php
//　エラー制御演算子
$a = 10;
$b = 0;
print $a / $b; // 0で除算すると通常はエラーメッセージが表示されます
print @($a / $b); // @をつけるとエラーメッセージは表示されません
print "<br>";
print "$a / $b";

?>
</body>
</html> 