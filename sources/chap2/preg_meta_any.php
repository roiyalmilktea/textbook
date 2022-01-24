<html>
<head>
<title>preg_meta_any.php</title>
</head>
<body>
<?php
// メタ文字：「.」任意の文字
 $arr_str = array ( 'abc', '123abc','123abc456','ABC','123ABC','bcd' );
 foreach ( $arr_str as $str ) 
 {
    if ( preg_match( "/abc./", $str ) )   // 文字列パターン/abc./の検索
    {
      print "$str<br>";          // 一致した場合に出力
    }
 }
?>
</body>
</html>
