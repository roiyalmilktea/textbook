<html>
<head>
<title>preg_replace2.php</title>
</head>
<body>
<?php
// preg_replace関数：複数パターン文字列の置換
$str = "Homepages is written by HTML Language.";
$pattern = array("/\bhomepages\b/i", "/\bhtml\b/i");
$replace = array("webpages", "XML");
$str_res = preg_replace( $pattern , $replace, $str ); 
// 複数の置換処理を配列で指定
print $str_res . "<br>";
?>
</body>
</html>