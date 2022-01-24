<html>
<head>
<title>form_text2d.php</title>
<!-- form:テキストデータの受信 -->
</head>
<body>
<?php
 $str = $_POST["data"];   // POSTメソッドでのフォームデータの受信
 $str = stripslashes($str); // エスケープ文字を元に戻す
 $str = "入力データは［". $str . "］です．<br>";
 print $str;
?>
</body>
</html>