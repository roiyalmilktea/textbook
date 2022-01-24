<?php
session_start();

$_SESSION = array();

if (isset($_COOKIE["PHPSESSID"])) {
	setcookie("PHPSESSID", '', time() - 1800, '/');
}

session_destroy();
?>
<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ログイン</title>
    </head>
    <body>
    	<form method="post" action="login.php" autocomplete="off">
	        <h1>ログイン画面</h1>
	        name:<input type="text" name="name" required><br>
	        pw:<input type="text" name="password" required><br>
	        <input type="submit" value="ログイン">
        </form>
        <br>
        <a href="signupGUI.html" ><input type="button" value="新規登録"></a>
        </form>
    </body>
</html>
