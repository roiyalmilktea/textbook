<?php
date_default_timezone_set('Asia/Tokyo');
$user = "root";
$pass = "root";
$comment = $_POST['comment'];
$date = date("Y-m-d H:i:s");
try {
    if (empty($_GET['thread_id'])) throw new Exception('ID不正');
    $thread_id = (int) $_GET['thread_id'];
	$dbh = new PDO('mysql:host=localhost;dbname=thread;charset=utf8', $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO comment(thread_id, comment, date) VALUES (?,?,?)";
	$stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $thread_id, PDO::PARAM_INT);
	$stmt->bindValue(2, $comment, PDO::PARAM_STR);
    $stmt->bindValue(3, $date, PDO::PARAM_STR);
	$stmt->execute();
	$dbh = null;
	echo "投稿完了しました。<br>\n";
    echo "<a href=\"detail.php?thread_id=" . $thread_id . "\">戻る</a>\n";
} catch (Exception $e) {
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}