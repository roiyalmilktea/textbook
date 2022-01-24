<html>
<head>
<title>preg_meta_option.php</title>
</head>
<body>
<?php
// 修飾子
 $arr_str = array ( "123","456xyz", "abc", "deFG","abc\n");
 foreach ( $arr_str as $str ) {
   if ( preg_match( "/^[a-z]+$/mi", $str ) ) {     /* 文字列パターン
                                        /^[a-z]+$/miの検索 */
     print $str . "<br>";                 // 一致した場合に出力
   }
 }
?>
</body>
</html>