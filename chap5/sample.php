<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>データベース接続</title>
</head>
<body>
<?php
// サーバー情報
$dsn = 'mysql:host=localhost';
//ユーザー IDとパスワード
$user = 'root';
//$pass = 'mysql';
// 接続
try {
$pdo = new PDO($dsn, $user);
echo "接続しました。<br><ul>";
// SQL文の発行
$sql = "show databases;";
// 結果を取得
foreach ($pdo -> query($sql) as $row) {
// print_r($row); // デバッグ用
echo "<li>".$row['Database']."</li>";
}
echo "</ul>";
// tryの中の処理中に何かエラーが発生した場合
} catch (PDOException $e) {
echo "エラーが発生しました<br>".$e->getMessage();
exit();
}
// データベース切断
$pdo = null;
?>
</body>
</html>