<?php
require_once '\MAMP\db_config.php';
try {
    if (empty($_GET['id'])) throw new Exception('ID不正');
    $id = (int) $_GET['id'];
    $dbh = new PDO('mysql:host=localhost;dbname=db2;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM plans WHERE id = ?;
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "日付:" . htmlspecialchars($result['day'],ENT_QUOTES,'UTF-8') . "<br>\n";
    echo "予定名:" . htmlspecialchars($result['plan_name'],ENT_QUOTES,'UTF-8') . "<br>\n";
    echo "ジャンル:" . htmlspecialchars($result['category'],ENT_QUOTES,'UTF-8') . "<br>\n";
    echo "重要度:" . htmlspecialchars($result['importance'],ENT_QUOTES,'UTF-8') . "<br>\n";
    echo "メモ:<br>" . nl2br(htmlspecialchars($result['memo'],ENT_QUOTES,'UTF-8')) . "<br>\n";
    $dbh = null;
    echo "<a href='index.php'>トップページへ戻る</a>";
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}