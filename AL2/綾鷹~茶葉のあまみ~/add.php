<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>詳細表示</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<?php
require_once 'db_config.php';
$recipe_name = $_POST['recipe_name'];
$howto = $_POST['howto'];
$material = $_POST['material'];
$category = (int) $_POST['category'];
$difficulty = (int) $_POST['difficulty'];
$persons = (int) $_POST['persons'];
$time = (int) $_POST['time'];
$budget = (int) $_POST['budget'];
try{
    $dbh = new PDO('mysql:host=localhost;dbname=db_1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO recipes (name, category, difficulty, persons, time, budget, howto, material) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $recipe_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $category, PDO::PARAM_INT);
    $stmt->bindValue(3, $difficulty, PDO::PARAM_INT);
    $stmt->bindValue(4, $persons, PDO::PARAM_INT);
    $stmt->bindValue(5, $time, PDO::PARAM_INT);
    $stmt->bindValue(6, $budget, PDO::PARAM_INT);
    $stmt->bindValue(7, $howto, PDO::PARAM_STR);
    $stmt->bindValue(8, $material, PDO::PARAM_STR);
    $stmt->execute();
    $dbh = null;
    echo "レシピの登録が完了しました。<br>";
    echo "<a href='index.php'>トップページに戻る</a>";
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}
?>

</body>
</html>