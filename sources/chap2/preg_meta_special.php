<html>
<head>
<title>preg_meta_special.php</title>
</head>
<body>
<?php
// メタ文字：「\d」数字
 $arr_str = array ( '200', '2000','2001','200x','20000','32000' );
 foreach ( $arr_str as $str ) {
   if ( preg_match( "/200\d/", $str ) ) {       /* 文字列パターン/200\d/の検索 */
     print "$str<br>";                 // 一致した場合に出力
   }
 }
?>
</body>
</html>
