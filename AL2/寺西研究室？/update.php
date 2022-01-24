<?php
require_once 'db_config.php';
$recipe_name = $_POST['recipe_name'];
$howto = $_POST['howto'];
$category = (int) $_POST['category'];
$difficulty = (int) $_POST['difficulty'];
$budget = (int) $_POST['budget'];
$ingredient = $_POST['ingredient'];
$ing_sol = (int) $_POST['ing_sol'];
$ing_sug = (int) $_POST['ing_sug'];
$ing_soy = (int) $_POST['ing_soy'];
$ing_egg = (int) $_POST['ing_egg'];
$ing_mil = (int) $_POST['ing_mil'];
try{
	if (empty($_POST['id'])) throw new Exception('ID不正');
	$id = (int) $_POST['id'];
	$dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE recipes_t SET recipe_name = ?, category = ?, difficulty = ?, budget = ?, howto = ?, ingredient = ?, ing_sol = ?, ing_sug = ?, ing_soy = ?, ing_egg = ?, ing_mil = ? WHERE id = ?";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1,$recipe_name,PDO::PARAM_STR);
	$stmt->bindValue(2,$category,PDO::PARAM_INT);
	$stmt->bindValue(3,$difficulty,PDO::PARAM_INT);
	$stmt->bindValue(4,$budget,PDO::PARAM_INT);
	$stmt->bindValue(5,$howto,PDO::PARAM_STR);
	$stmt->bindValue(6,$ingredient,PDO::PARAM_STR);
	$stmt->bindValue(7,$ing_sol,PDO::PARAM_INT);
	$stmt->bindValue(8,$ing_sug,PDO::PARAM_INT);
	$stmt->bindValue(9,$ing_soy,PDO::PARAM_INT);
	$stmt->bindValue(10,$ing_egg,PDO::PARAM_INT);
	$stmt->bindValue(11,$ing_mil,PDO::PARAM_INT);
	$stmt->bindValue(12,$id,PDO::PARAM_INT);
	$stmt->execute();
	$dbh = null;
	echo "ID: " .htmlspecialchars($id,ENT_QUOTES,'UTF-8') . "レシピの更新が完了しました。<br>";
	echo "<a href='list.php'>トップページへ戻る</a>";
}catch (Exception $e) {
	echo "エラー発生：" .htmlspecialchars($e->getMessage(), ENT_QUOTES,'UTF-8') . "<br>";
	die();
}
?>