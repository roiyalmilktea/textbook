<?php
// 関数の定義
function usr_sum($a,$b) {            // 値渡しの引数
  $a += $b;                    // 引数$aの値を変更
  print "合計は" . $a . "です<br>";
}
?>
<html>
<head>
<title>user_function2.php</title>
</head>
<body>
<?php
// ユーザ定義関数：引数の値渡し例
 $a = 5;
 $b = 10;
 $sum = usr_sum($a,$b);                   // 関数の呼び出し
 print "変数の値は" . $a . " と " . $b . "です<br>";   // 変数の値の確認
?>
</body>
</html>