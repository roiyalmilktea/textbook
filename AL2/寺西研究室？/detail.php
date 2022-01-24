<?php
require_once 'db_config.php';
try{
	if(empty($_GET['id'])) throw new Exception('ID不正');
	$id = (int) $_GET[('id')];
	$dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM recipes_t WHERE id = ?";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	echo "料理名：" . htmlspecialchars($result['recipe_name'],ENT_QUOTES,'UTF-8') . "<br>\n";
	echo "カテゴリ：";
	switch(htmlspecialchars($result['category'],ENT_QUOTES,'UTF-8')){
		case 1;
			echo "和食";
			break;
		case 2;
			echo "中華";
			break;
		case 3;
			echo "洋食";
			break;
		default;
			echo "null";
			break;
	}
	echo "<br>";
	echo "難易度：";
	switch(htmlspecialchars($result['difficulty'],ENT_QUOTES,'UTF-8')){
		case 1;
			echo "簡単";
			break;
		case 2;
			echo "普通";
			break;
		case 3;
			echo "難しい";
			break;
		default;
			echo "null";
			break;
	}
	echo "<br>";
	echo "予算：" . htmlspecialchars($result['budget'],ENT_QUOTES,'UTF-8') . "円<br>\n";
	echo "材料：";
	if((htmlspecialchars($result['ing_sol'],ENT_QUOTES,'UTF-8')) == 1) echo "塩 ";
	if((htmlspecialchars($result['ing_sug'],ENT_QUOTES,'UTF-8')) == 1) echo "砂糖 ";
	if((htmlspecialchars($result['ing_soy'],ENT_QUOTES,'UTF-8')) == 1) echo "しょうゆ ";
	if((htmlspecialchars($result['ing_egg'],ENT_QUOTES,'UTF-8')) == 1) echo "たまご ";
	if((htmlspecialchars($result['ing_mil'],ENT_QUOTES,'UTF-8')) == 1) echo "牛乳 ";
	echo "<br>\n";
	echo "その他材料：" . nl2br(htmlspecialchars($result['ingredient'],ENT_QUOTES,'UTF-8')) . "<br>\n";
	echo "作り方：<br>" . nl2br(htmlspecialchars($result['howto'],ENT_QUOTES,'UTF-8')) . "<br><br>\n";


	print_r($result);
	$dbh = null;
	echo "レシピの登録が完了しました。<br>";
	echo "<a href='list.php'>トップページへ戻る</a>";
} catch (Exception $e) {
	echo "エラー発生：" .htmlspecialchars($e->getMessage(), ENT_QUOTES,'UTF-8') . "<br>";
	die();
}
?>