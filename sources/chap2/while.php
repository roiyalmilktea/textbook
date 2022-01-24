<html>
<head>
<title>while.php</title>
</head>
<body>
<?php
// while文
 $i = 1;              // $iを1で初期化
 while ( $i <= 3 )         // $iが3になるまで繰り返す
 { 
   print $i++ . "<br>";     // $iは出力後1加算
 }
 print "while文を終了しました．<br>";
?>
</body>
</html>