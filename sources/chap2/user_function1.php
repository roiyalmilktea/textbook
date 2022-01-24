<?php
// ユーザ定義関数の定義
function disp_var($disp,$var,$var_name)
{
 if($disp == 0){return;}
 print $var_name . " = " . $var . "<br>";
}
?>
<html>
<head>
<title>user_function1.php</title>
</head>
<body>
<?php
// ユーザ定義関数の使用例
 $name = "yamada";
 disp_var(1,$name,'$name');   // ユーザ定義関数の呼び出し
?>
</body>
</html>