<?php
//cookie処理は必ずHTMLタグを書き出す前に行う
$value = "園田誠";

//有効期限が0のcookie（セッションcookie）の場合
setcookie("name", $value);

//有効期限ありのcookieの場合は
//現在時(time())に秒を足して有効期限を設定する
setcookie("name", $value, time()+3600);
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head><body>
<p>
リンクでページを<a href="cok_2.php">移動</a>してcookieが利用できることを確認してください。
</p>
</body></html>
