<?php
require_once '\MAMP\db_config.php';
$day = $_POST['day'];
$plan_name = $_POST['plan_name'];
$memo = $_POST['memo'];
$category = (int) $_POST['category'];
$importance = (int) $_POST['importance'];
try {
    if (empty($_POST['id'])) throw new Exception('ID不正');
    $id = (int) $_POST['id'];
    $dbh = new PDO('mysql:host=localhost;dbname=db2;charset=utf8', $user,$pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE plans SET day = ? plan_name = ?, category = ?, importance = ?, memo = ? WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $day, PDO::PARAM_STR);
    $stmt->bindValue(2, $plan_name, PDO::PARAM_STR);
    $stmt->bindValue(3, $category, PDO::PARAM_INT);
    $stmt->bindValue(4, $importance, PDO::PARAM_INT);
    $stmt->bindValue(5, $memo, PDO::PARAM_STR);
    $stmt->bindValue(6, $id, PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;
    echo "ID: " . htmlspecialchars($id,ENT_QUOTES,'UTF-8') . "予定の更新が完了しました。<br>";
    echo "<a href='index.php'>トップページへ戻る</a>";
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}