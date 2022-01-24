<html>
<head>
<title>foreach2.php</title>
</head>
<body>
<?php
 // foreach文（２）
 $array_date = getdate();
 foreach ($array_date as $key => $value) {      // 配列のキーを$keyに、要素をに$valueに代入する
   print "$key = $value<br>";             // 配列のキーと値を出力する
 }
?>
</body>
</html>