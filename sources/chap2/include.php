<?php
// include文
include "user.php";  /* 'user.php'ファイルを
             この位置に読み込みます*/
include "common.php"; /* 'common.php'ファイルを
              この位置に読み込みます*/
?>
<html>
<head>
<title>include.php</title>
</head>
<body>
<?php
 $name = "yamada";
 disp_var(1,$name,'$name'); /* ユーザ定義関数disp_var()は
                includeファイル'common.php'
                の中で定義されている．*/
 disp_var(1,DEBUG,'DEBUG'); /* 定数DEBUGはincludeファイル
                 'user.php'の中で定義されている．*/
?>
</body>
</html>