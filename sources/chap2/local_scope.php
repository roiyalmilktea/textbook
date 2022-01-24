<html>
<head>
<title>local_scope.php</title>
</head>
<body>
<?php
// グローバルスコープ
 $str = "local_scope";      // グローバルスコープの変数
 output_str( );         // ユーザ定義関数内で同名の$str変数を処理
 print "グローバルスコープ<br>";
 print $str . "<br>";      // 同じスクリプト内で，$strを処理
 
function output_str( )      // ユーザ定義関数
{
// ローカルスコープ
 print "ローカルスコープ<br>";
 print $str . "<br>";       /* ローカル変数であり，未定義なので
                      何も出力されない*/
 $str = "global_scope";         
}
?>
</body>
</html>
