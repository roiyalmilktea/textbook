<html>
<head>
<title>preg_grep.php</title>
</head>
<body>
<?php
// preg_grep関数
 $arr_str = array ( "123","456xyz", "abc", "deFG","abc\n");
 $arr_res = preg_grep( "/^[a-z]+$/i", $arr_str );
                               /* 文字列パターン
                                       /^[a-z]+$/iの検索 */
 foreach ( $arr_res as $val ) {
   print $val . "<br>";
 }
?>
</body>
</html>