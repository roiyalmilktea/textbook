<?php
// セッションの開始
session_start();
?>
<html>
<head>
<title>session_start2.php</title>
<!-- セッションの開始:セッション変数の登録 -->
</head>
<body>
<?php
 print "session_id = " . session_id() . "<br>"; // セッション変数の出力
 if (isset($_POST["name"])) {
   $name = $_POST["name"];
   $_SESSION["s_name"]=$name; // セッション変数の登録
   print "ようこそ！" . $_SESSION["s_name"] . "さん。<br>";
   print_r($_SESSION); 
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