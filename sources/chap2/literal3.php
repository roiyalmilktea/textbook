<html>
<head>
<title>literal3.php</title>
</head>
<body>
<?php
// エスケープシーケンス
 $str = "Hello\tMr. Yamada\n\n";
 print "$str <br>";        /* "で囲まれた文字列
                  （エスケープシーケンスが実行される） */
 print '$str <br>';       // 'で囲まれた文字列
?>
</body>
</html>