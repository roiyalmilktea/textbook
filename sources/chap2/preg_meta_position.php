<html>
<head>
<title>preg_meta_position.php</title>
</head>
<body>
<?php
// メタ文字：「\b」単語境界
 $arr_str = array ( 'newspaper', 'news','a new car','new','renew','new_' );
 foreach ( $arr_str as $str ) {
   if ( preg_match( "/\bnew\b/", $str ) ) {    //文字列パターン/\bnew\b/の検索
     print "$str<br>";                // 一致した場合に出力
   }
 }
?>
</body>
</html>