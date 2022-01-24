<html>
<head>
<title>break2.php</title>
</head>
<body>
<?php
//break文でオプション引数を使用する。
$i=0;
while(++$i){
switch($i){
case 5:
echo"At5<br>";
break 1;//switch構造の１つのループ構造のみを抜ける
case 10:
echo "At10;quitting<br>";
break 2;//switchとwhileの２つのループ構造を抜ける
default:
echo"$i<br>";
break;
}
}
?>
</body>
</html>
