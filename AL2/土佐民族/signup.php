<?php

require 'password.php';

$count = 0;

$user = "root";
$pass = "root";

$name = $_POST['name'];
$password = $_POST['password'];

try {
    $dbh = new PDO('mysql:host=localhost;dbname=logindb;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //名前かぶりを防ぐ
    $sql = "SELECT * FROM usertable WHERE name = '$name'";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($result as $row) {
    	$count++;
    }
    if($count!=0){
    	echo "違う名前にしてください!";
    	return;
    }
    //
    $sql = "INSERT INTO usertable (name,password) VALUES (?, ?)";
    $stmt = $dbh->prepare($sql);
    
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $password, PDO::PARAM_STR);
    
    $stmt->execute(array($name,password_hash($password,PASSWORD_DEFAULT)));
    $dbh = null;
    echo "登録が完了しました。";
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>登録完了</title>
    </head>
    <body>
        <br>
        <a href="index.php" ><input type="button" value="ログイン画面に戻る"></a>
        </form>
    </body>
</html>