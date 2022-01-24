<html>
<head>
<title>preg_match.php</title>
</head>
<body>
<?php
// preg_match関数
 $str = "WEB means a server system using world wide web technology.";
                      //
 if( preg_match( "/\bweb\b/" , $str ) )  // preg_match関数の呼び出し
 {                    // $bは単語境界を意味する
    print "マッチしました";
 } else {
    print "マッチしません";
 }
?>
</body>
</html>