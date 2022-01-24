<html>
<head>
<title>foreach2.php</title>
</head>
<body>
<?php
 // 連想配列への代入
 $arr_data['氏名'] = "山田太郎"; 
 $arr_data['住所'] = "横浜市都筑区";
 // foreach文
 foreach($arr_data as $key => $value)
 {
   print "$key = $value<br>";
 }
 print "foreach文を終了しました．<br>";
?>
</body>
</html> 