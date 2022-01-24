<?php
require_once '\MAMP\db_config.php';
try {
    if (empty($_GET['id'])) throw new Exception('ID不正');
    
    $id = (int) $_GET['id'];
    
    $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "DELETE FROM recipes WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $dbh = null;
    echo "ID:" . htmlspecialchars($id, ENT_QUOTES,'UTF-8') . "の削除が完了しました。<br>\n";
    
    echo "<a href='/wordpress/index_recipe/'>トップページに戻る</a>";
    
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, UTF-8) . "<br>";
    echo "<br><a href='/wordpress/index_recipe/'>トップページに戻る</a>";
    
    die();
}
?>