<html>
<head>
<title>priority.php</title>
</head>
<body>
<?php
// 演算子の優先順位
 $a = 1+5*3;    // *が先に処理されるので，$aは16
 $b = (1+5)*3;   // ( )の中が先に処理されるので，$bは18
 $c = 100/20*5;  // 左の演算子から先に処理されるので，$cは25
 $d = $e = 20;   // 代入演算子は右から順に処理されるので，$dも$eも20
 print "$a<br>";
 print "$b<br>";
 print "$c<br>";
 print "$d<br>";
 print "$e<br>";
?>
</body>
</html>