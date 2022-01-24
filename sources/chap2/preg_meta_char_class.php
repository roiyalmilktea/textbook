<html>
<head>
<title>preg_meta_char_class.php</title>
</head>
<body>
<?php
// メタ文字：文字クラス
 $arr_str = array ( "123","456xyz", "abc", "deFG","abc\n");
 foreach ( $arr_str as $str ) {
   if ( preg_match( "/^[a-z]+$/m", $str ) ) {      /* 文字列パターン
                                        /^[a-z]+$/mの検索 */
     print $str . "<br>";                 // 一致した場合に出力
   }
 }
?>
</body>
</html>