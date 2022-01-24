<html>
<head>
<title>global.php</title>
</head>
<body>
<?php
// global文
 $str = "global_scope";       // グローバルスコープの変数
 output_str( );           // ユーザ定義関数内で同名の$str変数を処理
 print  "グローバルスコープ<br>";
 print $str . "<br>";        /* 同じスクリプト内で，$strを処理
                    ユーザ定義関数内で変更された値が出力される */
//
// ユーザ定義関数の定義
function output_str( )       // ユーザ定義関数
{
  global $str;           // グローバル変数を使用することを宣言
  print  "ローカルスコープ<br>";
  print $str . "<br>";      // グローバル変数の値が出力される
  $str = "local_scope";      // グローバル変数の変更
} 
?>
</body>
</html>