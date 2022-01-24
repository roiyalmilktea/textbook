<?php
// セッションの開始
session_start();
?>
<html>
<head>
<title>session_start1.php</title>
<!-- セッションの開始：セッションIDの確認 -->
</head>
<body>
<?php
 print "session_id = " . session_id() . "<br>"; // セッションIDの確認
 print "session_name = " . session_name() . "<br>";    // セッション名の確認
 print "session_save_path = " . session_save_path() . "<br>";
     // セッション情報格納ディレクトリの確認
?>
</body>
</html>