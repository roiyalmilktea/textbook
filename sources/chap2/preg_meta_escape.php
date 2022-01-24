<html>
<head>
<title>preg_meta_escape.php</title>
</head>
<body>
<?php
// メタ文字：「\」エスケープ文字
 $arr_str = array ( 'abc.html', 'ade.html','123.html','abc.htm','abchtml' );
 foreach ( $arr_str as $str ) {
   if ( preg_match( "/a..\.html/", $str ) ) {     //文字列パターン/a..\.html/の検索
     print "$str<br>";                 // 一致した場合に出力
   }
 }
?>
</body>
</html>
