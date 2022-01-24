<?php

session_start();
/*
//中身があるときtrue
if(!empty($_SESSION['name'])){
 	goto label;
}
*/
require 'password.php';

$count = 0;

$user = "root";
$pass = "root";

//$name = $_POST['name'];
if(!empty($_SESSION['name'])){
 	$name = $_SESSION['name'];
}else{
	$name = $_POST['name'];
}

//$password = $_POST['password'];
if(!empty($_SESSION['password'])){
 	$password = $_SESSION['password'];
}else{
	$password = $_POST['password'];
}

try {
    $dbh = new PDO('mysql:host=localhost;dbname=logindb;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM usertable WHERE name = '$name'";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($result as $row) {
    	/*
        echo "<tr>\n";
        echo "<td>" . htmlspecialchars($row['name'],ENT_QUOTES,'UTF-8') . "</td>\n";
        echo "<td>" . htmlspecialchars($row['password'],ENT_QUOTES,'UTF-8') . "</td>\n";
        echo "</tr>\n";
        */
        $count++;
    }
    
    if($count==0){
    	echo 'nameかパスワードが間違っています!';
	    return;
    }else{
    	if (password_verify($password, $row['password'])) {
		    echo 'ログインしました';
		    
		    $_SESSION['name'] = $name;
		    $_SESSION['password'] = $password;
		} else {
		    echo 'nameかパスワードが間違っています!';
		    return;
		}
    }
    $count = 0;
    $dbh = null;
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}

//label:
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <p>ようこそ<b><?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES); ?></b>さん</p>
        <br>
        <a href="./shooting/index.html" ><input type="button" value="ゲーム"></a>
        <br>
        <br>
        <a href="scoredisp.php" ><input type="button" value="スコア・ランキング"></a>
        <br>
        <br>
        <a href="index.php" ><input type="button" value="ログアウト"></a>
    </body>
</html>
