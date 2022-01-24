<?php
// セッションの開始
session_start();
?>
<html>
<head>
<title>session_start5.php</title>
<!-- セッションの開始:セッション変数の登録 -->
</head>
<body>
<?php
 print "session_id = " . session_id() . "<br>";// セッションIDの出力
 print '<br>$_POST[] の内容の確認；<br>';
 print_r($_POST);
 print "<br>";
 print '<br>$_COOKIE[] の内容の確認；<br>';// クッキー変数の出力
 print_r($_COOKIE);
 print "<br>";
 if (isset($_POST["name"])) {
   $name = $_POST["name"];
   $_SESSION["s_name"]=$name;// セッション変数の登録
   print "ようこそ！" . $_SESSION["s_name"] . "さん。<br>";
   print '$_SESSION[]の内容の確認；<br>';
   print_r($_SESSION); // セッション変数の出力
   print "<br>"; 
?>
   <a href="session_start5a.php?<?=SID?>">次ページへ</a><br>
  <!-- 定数SIDの記述 -->
<?php
 } else {
?>
   <form method="post">
     氏名を記入してください。<br>
     氏名：<input size="30" type="text" name="name"><br>
     <input type="submit" value="登録">
   </form>
<?php
 }
?>
</body>
</html>