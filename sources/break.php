<html>
<head>
<title>break.php</title>
</head>
<body>
<?php
$arr_name = array ('kato', 'saito', 'tanaka', 'yamada', 'wajima');
// break文
foreach ($arr_name as $value) // 配列の要素を順に$valueに代入する
{
if ( $value == 'yamada' ) 
{
print $value . "さんで終わります<br>";
break; // 'yamada'まできたらforeachを抜け出す
}
print "$value<br>"; 
}
print "break文でfoeach文を抜け出しました<br>"; 
?>
</body>
</html> 