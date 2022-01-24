<html>
<head>
<title>var3.php</title>
</head>
<body>
<?php
// 変数アドレスの参照による代入
$var1 = 10;
$copy = $var1;
$var1 = 20;
print $var1 . "<br>"; // $var1の出力（値は20）
print $copy . "<br>"; // $copyの出力（値は10のまま）
print "<br>";
// 
$copy = &$var1; // 変数の参照による代入
print $copy . "<br>"; // $copyの出力（値は20）
$var1 = 30;
print $copy . "<br>";// $copyの出力（値は30に変更）
print "<br>";
//
$copy = 40;// 実際は$var1に40が代入される
print $var1. "<br>"; // $var1の出力（値は40に変更）
print "<br>";
//
$var2 = 50;
$copy = &$var2; // 変数の参照による代入
print $copy . "<br>";// $copyの出力（値は50に変更）
?>
</body>
</html>