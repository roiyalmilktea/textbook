<html>
<head>
<title>foreach.php</title>
</head>
<body>
<?php
 // array()関数による配列への値の代入
 $arr_weekday = array('日','月','火','水','木','金','土');
 // foreach文
 foreach ($arr_weekday as $value) 
 { 
  print "$value<br>";
 }
 print "foreach文を終了しました<br>"; 
?>
</body>
</html>