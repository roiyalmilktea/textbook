<?php
// セッションの開始
session_start();
?>
<html>
<head>
<title>session_ent.php</title>
<!-- セッションの入り口ページ -->
</head>
<?php
// セッションの継続
if(!isset($_SESSION)){     
 session_start();
}
// セッション変数に値がない場合は、セッションの入り口ページにジャンプ
if (! isset($_SESSION["s_name"])) {
  $_SESSION = array();// すべてのセッション変数のクリア
  session_destroy();  // セッション情報を破棄
  $url= "session_ent.php";
  header("Location: " . $url);
}
?>
<html>
<head>
<title>session_ent_a.php</title>
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
氏名は[<?=$_SESSION["s_name"]?>]ですね。<br>
</body>
</html>