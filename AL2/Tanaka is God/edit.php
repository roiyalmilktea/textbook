<?php
require_once '\MAMP\db_config.php';
try {
    if (empty($_GET['id'])) throw new Exception('ID不正');
    $id = (int) $_GET['id'];
    $dbh = new PDO('mysql:host=localhost;dbname=db2;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM plans WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $dbh = null;
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>予定</title>
</head>
<body>
予定の詳細変更<br>
<form method="post" action="update.php">
日付：<input type="text" name="day" value="<?php echo htmlspecialchars($result['day'], ENT_QUOTES, 'UTF-8'); ?>"><br>
予定名：<input type="text" name="plan_name" value="<?php echo htmlspecialchars($result['plan_name'], ENT_QUOTES, 'UTF-8'); ?>"><br>
カテゴリ：
<select name="category">
<option value="">選択してください。</option>
<option value="1" <?php if ($result['category'] === 1) echo "selected" ?>>仕事</option>
<option value="2" <?php if ($result['category'] === 2) echo "selected" ?>>遊び</option>
<option value="3" <?php if ($result['category'] === 3) echo "selected" ?>>その他</option>
</select>
<br>
重要度：
<input type="radio" name="importance" value="1" <?php if ($result['importance'] === 1) echo "checked" ?>>低
<input type="radio" name="importance" value="2" <?php if ($result['importance'] === 2) echo "checked" ?>>中
<input type="radio" name="importance" value="3" <?php if ($result['importance'] === 3) echo "checked" ?>>高
<br>
メモ：
<textarea name="memo" cols="40" rows="4" maxlength="150"><?php echo htmlspecialchars($result['memo'], ENT_QUOTES, 'UTF-8'); ?></textarea>
<br>
<input type="hidden" name="id" value="<?php echo htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8'); ?>">
<input type="submit" value="送信">
</form>
</body>
</html>