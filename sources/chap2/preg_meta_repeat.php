<html>
<head>
<title>preg_meta_repeat.php</title>
</head>
<body>
<?php
// メタ文字：「*」直前のパターンの0回以上の繰り返し
 $arr_str = array ( 'net', 'news','a new car','new','renew','new_' );
 foreach ( $arr_str as $str ) {
   if ( preg_match( "/new.*/", $str ) ) {        // 文字列パターン/new.*/の検索 
     print "$str<br>";                  // 一致した場合に出力
   }
 }
?>
</body>
</html>