<html>
<head>
<title>global_scope.php</title>
</head>
<body>
<?php
// グローバルスコープ
 $str = "global_scope";      // グローバルスコープの変数
 include 'global_scope.inc';   // 読み込みファイル内で，$strを処理
 print $str . "<br>";       // 同じスクリプト内で，$strを処理
?>
</body>
</html>
 