<html>
<head>
<title>static2.php</title>
</head>
<body>
<?php
// static変数
 usr_static( );                // ユーザ定義関数内でローカル変数を処理
 usr_static( );               // ユーザ定義関数内でローカル変数を処理
 usr_static( );                // ユーザ定義関数内でローカル変数を処理
//
// ユーザ定義関数の定義
function usr_static( ) {           // ユーザ定義関数
  static $var = 1;             // static変数の定義と初期化
  print $var . "<br>";
  $var++ ;                 // ローカル変数の値をインクリメント
}
?>
</body>
</html>