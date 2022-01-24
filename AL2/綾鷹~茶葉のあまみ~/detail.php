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
	try{
	    if (empty($_GET['id'])) throw new Exception('ID不正');
	    $id = (int) $_GET['id'];
	    $dbh = new PDO('mysql:host=localhost;dbname=db_1;charset=utf8', $user, $pass);
	    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "SELECT * FROM recipes WHERE id = ?";
	    $stmt = $dbh->prepare($sql);
	    $stmt->bindValue(1, $id, PDO::PARAM_INT);
	    $stmt->execute();
	    $result = $stmt->fetch(PDO::FETCH_ASSOC);
	    echo "<table id=\"main-table\">";
	    echo "<tr><td>料理名</td><td>" . htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8') . "</td></tr>\n";
	    echo "<tr><td>カテゴリ</td><td>" . htmlspecialchars($result['category'], ENT_QUOTES, 'UTF-8') . "</td></tr>\n";
	    echo "<tr><td>予算</td><td>" . htmlspecialchars($result['budget'], ENT_QUOTES, 'UTF-8') . "円</td></tr>\n";
	    echo "<tr><td>難易度</td><td>" . htmlspecialchars($result['difficulty'], ENT_QUOTES, 'UTF-8') . "</td></tr>\n";
	    echo "<tr><td>調理時間</td><td>" . htmlspecialchars($result['time'], ENT_QUOTES, 'UTF-8') . "分</td></tr>\n";
	    echo "<tr><td>人数</td><td>" . htmlspecialchars($result['persons'], ENT_QUOTES, 'UTF-8') . "人</td></tr>\n";
	    echo "<tr><td>材料</td><td>" . nl2br(htmlspecialchars($result['material'], ENT_QUOTES, 'UTF-8')) . "</td></tr>\n";
	    echo "<tr><td>作り方</td><td>" . nl2br(htmlspecialchars($result['howto'], ENT_QUOTES, 'UTF-8')) . "</td></tr>\n";
	    echo "</table>";
	    echo "<a href='index.php'>トップページに戻る</a>";
	    //print_r($result);
	    $dbh = null;
	    //var_dump($id);
	} catch (Exception $e) {
	    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	    die();
	}

	?>
</body>
</html>