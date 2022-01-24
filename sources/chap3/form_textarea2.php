<html>
<head>
<title>form_textarea2.php</title>
<!-- form:テキストエリアデータの受信 -->
</head>
<body>
<form action="form_textarea2.php" method="post">
入力データは以下です．<br>
<textarea name="data" rows="5" cols="40"><?=$_POST["data"]?></textarea>
<br>
<input type="submit" value=" OK ">
</form>
</body>
</html>