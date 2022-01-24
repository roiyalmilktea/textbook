<html>
<head>
<title>preg_split.php</title>
</head>
<body>
<?php
// preg_split関数：文字列の分割
 $str = "/usr/local/apache/htdocs/php";
 $arr_res = preg_split( "/\//" , $str );    /* preg_split関数の呼び出し
                         「/」で文字列を分割 */
 foreach( $arr_res as $val )
 {
   print $val . "<br>";
 }
?>
</body>
</html>