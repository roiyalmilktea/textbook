<html>
<head>
<title>preg_meta_position_m.php</title>
</head>
<body>
<?php
// メタ文字：「^」,「$」各行の先頭と終端
 $arr_str = array ( "123\n456\n", "abc\n45678\n","123\nabc456\n");
 foreach ( $arr_str as $str ) {
   if ( preg_match( "/^abc$/m", $str ) ) {       // 文字列パターン/^abc$/mの検索 
     print $str . "<br>";                 // 一致した場合に出力
   }
 }
?>
</body>
</html>