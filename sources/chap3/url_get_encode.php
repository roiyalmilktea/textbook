<html>
<head>
<title>url_get_encode.php</title>
<!-- リンクによるデータの送受信 -->
</head>
<body>
<?php
 $url = "form_text_get2.php?data=" . urlencode("今日は");
                   // urlencode関数の呼び出し
?>
<a href="<?= $url ?>">リンク</a>
</body>
</html>