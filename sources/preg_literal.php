
<html>
<head>
<title>preg_literal.php</title>
</head>
<body>
<?php
// 文字（リテラル）
$arr_str = array ( 'abc', '123abc','123abc456','ABC','123ABC','bcd' );
foreach ( $arr_str as $str )
{ 
if ( preg_match( "/abc/", $str ) ) // 文字列パターン/abc/の検索
{
print "$str<br>"; // 一致した場合に出力
}
}
?>
</body>
</html>