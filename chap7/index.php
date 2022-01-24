<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>レシピの一覧</title>
</head>
<body>
<h1>レシピの一覧</h1>
<p><a href="form.html">レシピの新規登録</a></p>
<p><a href="form_receive.html">データ入力のサンプル</a></p>
<?php
/*
*
* index.php 一覧表示処理
*/

//データベース設定の読み込み
require_once 'db_config.php';
//try〜catchにてエラーハンドリングを行う。
try {
	//PDOを使ったデータベースへの接続
	//$user,$passはdb_config.phpにて定義済み
	$dbh = new PDO('mysql:host=localhost;dbname=my_sample;charset=utf8', $user, $pass);

	//PDOの実行モードの設定
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//前データ取得のSQLを生成
	$sql = "SELECT * FROM recipes";
	//SQLの実行
	$stmt = $dbh->query($sql);
	//SQLの結果を$resultに取得する
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	//テーブル部分のHTMLを生成
	echo "<table>\n";
	echo "<tr>\n";
	echo "<th>料理名</th><th>発祥地</th><th>予算</th><th>難易度</th>\n";
	echo "</tr>\n";
	//取得したデータが無くなるまでforeach()で処理を繰り返す。
	//取得した値は各カラムに表示を行う。
	//ループ処理の開始
	foreach ($result as $row) {
		echo "<tr>\n";
		echo "<td>" . htmlspecialchars($row['recipe_name'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['nati'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['budget'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['difficulty'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>" . htmlspecialchars($row['howto'],ENT_QUOTES,'UTF-8') . "</td>\n";
		echo "<td>\n";
		echo "<a href=detail.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">詳細</a>\n";
		echo "|<a href=edit.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "|<a href=delete.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
		echo "</td>\n";
		echo "</tr>\n";
	//ループ処理の終了
	}
	//テーブルタグを閉じる
	echo "</table>\n";
	//接続を閉じる
	$dbh = null;

//try{}で発生したPDOExceptionはこの部分でcatchされる
} catch (PDOException $e) {
	//エラーメッセージ出力
	echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	//処理の終了
	die();
}
//PHPが終了した後にHTMLタグが記述されているためここでは終了タグが必要
?>
</body>
</html>
