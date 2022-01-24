<?php
date_default_timezone_set('Asia/Tokyo');
$user = "root";
$pass = "root";
$title = $_POST['title'];
$content = $_POST['content'];
$category = (int) $_POST['category'];
$date = date("Y-m-d H:i:s");
try {
	$dbh = new PDO('mysql:host=localhost;dbname=thread;charset=utf8', $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO thread (title, content, category, date) VALUES (?,?,?,?)";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $title, PDO::PARAM_STR);
	$stmt->bindValue(2, $content, PDO::PARAM_STR);
	$stmt->bindValue(3, $category, PDO::PARAM_INT);
    $stmt->bindValue(4, $date, PDO::PARAM_STR);
	$stmt->execute();
	$dbh = null;
	echo "投稿完了しました。<br>";
    echo "<a href=\"home.php\">ホームへ戻る</a>";
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}