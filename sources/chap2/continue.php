<head>
<title>continue.php</title>
</head>
<body>
<?php
 // continue文
 $i = 0;
 while (++$i <= 10) 
 {
   if ( $i % 2 ) continue;    // 奇数のときにスキップ
   print "$i<br>";
 }
?>
</body>
</html>