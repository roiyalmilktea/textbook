<?php
include "common353.php";
?>
<html>
<head>
<title>form_password_debug.php</title>
<!-- form:パスワード -->
</head>
<body>
<?php
disp_mes(1,"GETメソッド，POSTメソッドの値の確認");
disp_arr(2,$_GET,'$_GET');
disp_arr(2,$_POST,'$_POST');
$name = $_POST['user_name'];
$password = $_POST['user_passwd'];
disp_var(3,$name,'$name');
disp_var(4,$password,'$password');
disp_var_hex(5,$password,'$password');
?>
<form action="form_password_debug.php" method="post">
ユーザ名 ：
<input type="text" name="user_name" size=20 value='<?=$name?>'><br>
パスワード：
<input type="password" name="user_passwd" size=20 value='<?=$password?>'><br>
<input type="submit" value=" OK ">
</form>
<form action="form_password_debug.php" method="get">
ユーザ名 ：
<input type="text" name="user_name" size=20 value='<?=$name?>'><br>
パスワード：
<input type="password" name="user_passwd" size=20 value='<?=$password?>'><br>
<input type="submit" value=" OK ">
</form>
</body>
</html>