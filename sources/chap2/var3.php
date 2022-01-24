<html>
<head>
<title>var3.php</title>
</head>
<body>
<?php
// 可変変数
$var = "str_name";
$$var = "yamada"; // 可変変数への代入
print $var . "<br>";
print ${$var} . "<br>";// 可変変数の出力
$str_name = "tanaka" . "<br>";
print ${$var} . "<br>";
?>
</body>
</html>