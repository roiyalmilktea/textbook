<html>
<head>
<title>form_text26.php</title>
<!-- form:テキストデータの受信 -->
</head>
<body>
<?php
 $str = $_POST["data"];   // POSTメソッドでのフォームデータの受信
 $str = stripslashes($str); // エスケープ文字を元に戻す
 $str = nl_rep_br($str);  // 改行コードを改行タグに変換
 $str = "入力データは［". $str . "］です．<br>";
 print $str;
?>
</body>
</html>
<?php
function nl_rep_br($str)
{
 // 改行コードを改行タグに変換
 $str = preg_replace( "/(\r\n|\r|\n)/", "<br />", $str);
 return $str;
}
?>