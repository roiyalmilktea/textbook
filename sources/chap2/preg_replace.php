<html>
<head>
<title>preg_replace.php</title>
</head>
<body>
<?php
// preg_replace関数：文字列の置換
 $str = "Homepages is written by HTML Language.";
 print $str . "<br>";
 $str_res = preg_replace( "/\bhomepages\b/i" , "webpages", $str ); 
                      // preg_replace関数の呼び出し
 print $str_res . "<br>";
?>
</body>
</html>
