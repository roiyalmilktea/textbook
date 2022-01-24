<html>
<head>
<title>preg_match_all.php</title>
</head>
<body>
<?php
// preg_match_all関数：マッチしたすべての文字列の格納
 $str = "WEB means a server system using world wide web technology.";
 preg_match_all( "/\bweb\b/i" , $str, $arr_str ); 
                               /* preg_match_all関数の呼び出し
                                 パターン修飾子「i」を使用 */
 foreach( $arr_str[0] as $val ) {            // キー0を指定
   print $val . "<br>";
 }
?>
</body>
</html>