<?php
session_start();
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head><body>
<?php
error_reporting(E_ALL);
//セッション変数に値をセット
$_SESSION[name] = "園田誠";

//設定したセッション変数の中身を確認しておきます
echo $_SESSION['name']."さん，こんにちは";
?>

<p>
リンクでページを<a href="ses_2.php">移動</A>
してもセッション変数が生きていることを確認してください。
</p></body></html>