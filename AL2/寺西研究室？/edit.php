<?php
require_once 'db_config.php';
try{
	if (empty($_GET['id'])) throw new Exception('ID不正');
	$id = (int) $_GET['id'];
	$dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM recipes_t WHERE id = ?";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$dbg = null;
}catch (Exception $e) {
	echo "エラー発生：" .htmlspecialchars($e->getMessage(), ENT_QUOTES,'UTF-8') . "<br>";
	die();
}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset = "UTF-8">
		<title>入力フォーム</title>
	</head>
	<body>
		レシピの編集<br>
		<form method="post" action="update.php">
			料理名：<input type="text" name="recipe_name" value="<?php echo htmlspecialchars($result['recipe_name'],ENT_QUOTES,'UTF-8'); ?>"><br>
			カテゴリ：
			<select name="category">
				<option value="">選択してください。</option>
				<option value="1" <?php if ($result['category'] === 1) echo "selected" ?>>和食</option>
				<option value="2" <?php if ($result['category'] === 2) echo "selected" ?>>中華</option>
				<option value="3" <?php if ($result['category'] === 3) echo "selected" ?>>洋食</option>
			</select>
			<br>
			難易度：
			<input type="radio" name="difficulty" value = "1" <?php if ($result['difficulty'] === 1 ) echo "checked" ?>>簡単
			<input type="radio" name="difficulty" value = "2" <?php if ($result['difficulty'] === 2 ) echo "checked" ?>>普通
			<input type="radio" name="difficulty" value = "3" <?php if ($result['difficulty'] === 3 ) echo "checked" ?>>難しい
			<br>
			予算：<input type="number" name="budget" value="<?php echo htmlspecialchars($result['budget'],ENT_QUOTES,'UTF-8'); ?>">円
			<br>
			材料：
			<!--チェックが入ってない際に0を返すため、hiddenで初期値を0にする-->
			<input type="hidden" name="ing_sol" value="0">
			<input type="checkbox" name="ing_sol" value="1" <?php if ($result['ing_sol'] === 1 ) echo "checked" ?>>塩

			<input type="hidden" name="ing_sug" value="0">
			<input type="checkbox" name="ing_sug" value="1" <?php if ($result['ing_sug'] === 1 ) echo "checked" ?>>砂糖
			<input type="hidden" name="ing_soy" value="0">
			<input type="checkbox" name="ing_soy" value="1" <?php if ($result['ing_soy'] === 1 ) echo "checked" ?>>しょうゆ
			<input type="hidden" name="ing_egg" value="0">
			<input type="checkbox" name="ing_egg" value="1" <?php if ($result['ing_egg'] === 1 ) echo "checked" ?>>たまご
			<input type="hidden" name="ing_mil" value="0">
			<input type="checkbox" name="ing_mil" value="1" <?php if ($result['ing_mil'] === 1 ) echo "checked" ?>>牛乳
			<br>
			その他材料：
			<br>
			<textarea name="ingredient" cols="40" rows="4" maxlength="150"><?php echo htmlspecialchars($result['ingredient'],ENT_QUOTES,'UTF-8'); ?></textarea>
			<br>
			作り方：
			<br>
			<textarea name="howto" cols="40" rows="4" maxlength="150"><?php echo htmlspecialchars($result['howto'],ENT_QUOTES,'UTF-8'); ?></textarea>
			<br>
			<input type="hidden" name="id" value="<?php echo htmlspecialchars($result['id'],ENT_QUOTES,'UTF-8'); ?>">
			<input type="submit" value="送信">
			<input type="reset" value ="リセット">
		</form>
		<a href='list.php'>トップページへ戻る<br></a>
	</body>
</html>
