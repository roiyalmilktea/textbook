<html>
<head>
<title>foreach.php</title>
</head>
<body>
<?php
// foreach文
 $array_date = getdate();            //getdate()は日付情報を配列に格納する組込み関数
 foreach ($array_date as $value) {       // 配列の要素を順に$valueに代入する
   print "$value<br>";
 }
?>
</body>
</html>