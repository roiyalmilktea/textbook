<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>レシピの一覧</title>
	</head>
	<body>
		<h1>レシピの一覧</h1>
		<a href="index.html">レシピの新規登録</a>
		<?php
		require_once 'db_config.php';
		try{
		$dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM recipes_t";
		$stmt = $dbh->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo "<table>\n";
		echo "<tr>\n";
		echo "<th>料理名</th><th>予算</th><th>難易度</th><th>カテゴリ</th>\n";
		echo "</tr>\n";
		foreach ($result as $row){
			echo "<tr>\n";
			echo "<td>" . htmlspecialchars($row['recipe_name'] ,ENT_QUOTES,'UTF-8') . "</td>\n";
			echo "<td>" . htmlspecialchars($row['budget'] ,ENT_QUOTES,'UTF-8') . "</td>\n";
			//switchで日本語変換
			switch(htmlspecialchars($row['difficulty'] ,ENT_QUOTES,'UTF-8')){
				case 1;
					echo "<td>簡単</td>\n";
					break;
				case 2;
					echo "<td>普通</td>\n";
					break;
				case 3;
					echo "<td>難しい</td>\n";
					break;
				default;
					echo "<td>null</td>\n";
					//フォーム側のエラー等で難易度が送信されない場合nullを表示
			}
			switch(htmlspecialchars($row['category'] ,ENT_QUOTES,'UTF-8')){
				case 1;
					echo "<td>和食</td>\n";
					break;
				case 2;
					echo "<td>中華</td>\n";
					break;
				case 3;
					echo "<td>洋食</td>\n";
					break;
				default;
					echo "<td>null</td>\n";
					//エラー時null表示
			}
			/*
			#難易度表示
			echo "<td>" . htmlspecialchars($row['difficulty'] ,ENT_QUOTES,'UTF-8') . "</td>\n";
			#カテゴリ表示
			echo "<td>" . htmlspecialchars($row['category'] ,ENT_QUOTES,'UTF-8') . "</td>\n";
			*/
			echo "<td>\n";
			echo "<a href=detail.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">詳細</a>\n";
			echo "|<a href=edit.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
			echo "|<a href=delete.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
			echo "</td>\n";
			echo "</tr>\n";
		}
		echo "</table>\n";
		$dbh = null;
		} catch (Exception $e) {
			echo "エラー発生: " . htmlspecialchars($e->getMessage(),ENT_QUOTES, 'UTF-8') . "<br>";
			die();
		}
		?>
	</body>
</html>