<?php
// セッションの継続
session_start();
$name = $_SESSION["s_name"];
?>
<html>
<head>
<title>session_start5a.php</title>
<!-- セッションの継続 -->
</head>
<body>
次のページです。<br>
<?php
 print "session_id = " . session_id() . "<br>";
 print '$_GET[] の内容の確認；<br>';
 print_r($_GET);
 print '<br>$_POST[] の内容の確認；<br>';
 print_r($_POST);
 print '<br>$_SESSION[]の内容の確認；<br>';
 print_r($_SESSION);
 print "<br>";
 print '<br>$_COOKIE[]の内容の確認；<br>';
 print_r($_COOKIE);
 print "<br>";
?>
氏名は[<?=$name?>]ですね。<br>
</body>
</html>