<html>
<head>
<title>preg_match2.php</title>
</head>
<body>
<?php
// preg_match関数：マッチした文字列の格納
 $str = "WEB means a server system using world wide web technology.";
                                 //
 if( preg_match( "/\bweb\b/" , $str, $arr_str ) ) {  // マッチした文字列を$arr_strに格納
   print "マッチしました->";
   print $arr_str[0];                    /*マッチした文字列を出力
                                   配列キー0を指定する */
 } else {
   print "マッチしません";
 }
?>
</body>
</html>
