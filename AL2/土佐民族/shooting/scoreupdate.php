<?php

session_start();

$user = "suzuki";
$pass = "suzukisuzuki";

$name = $_SESSION['name'];
$score = $_POST["score"];

try {
    $dbh = new PDO('mysql:host=localhost:8889;dbname=logindb;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //すでに挿入してある値以下だとreturn
    $sql = "SELECT * FROM usertable WHERE name = '$name'";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($result as $row) {
    	if($score <= $row['score']){
    		return;
    	}
    }
    
    //scoreを挿入
    $sql = "UPDATE usertable SET score = ? WHERE name = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $score, PDO::PARAM_INT);
    $stmt->bindValue(2, $name, PDO::PARAM_STR);
    $stmt->execute();
    $dbh = null;
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}
?>