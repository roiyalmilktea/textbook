<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>予定一覧</title>
</head>
<body>
<h1>予定一覧</h1>
<form action="" method="get">
       <p>予定の検索</p>
       <input type="text" name="search" value="<?php echo $search_value ?>"><br>
       <input type="submit" name="" value="検索">
</form>
<br><a href="form.html">予定の新規登録</a>
<?php
require_once 'db_config.php';
try {
    $dbh = new PDO('mysql:host=localhost;dbname=db2;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $search_value = $search;
    }else {
        $search = '';
        $search_value = '';
    }
    $sql = "SELECT * FROM plans where plan_name LIKE '%$search%' ORDER BY day ASC";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<table>\n";
    echo "<tr>\n";
    echo "<th>日付</th><th>予定名</th><th>重要度</th>\n";
    echo "</tr>\n";
    foreach ($result as $row) {
        echo "<tr>\n";
        echo "<td>" . htmlspecialchars($row['day'],ENT_QUOTES,'UTF-8') . "</td>\n";
        echo "<td>" . htmlspecialchars($row['plan_name'],ENT_QUOTES,'UTF-8') . "</td>\n";
        echo "<td>" . htmlspecialchars($row['importance'],ENT_QUOTES,'UTF-8') . "</td>\n";
        echo "<td>\n";
        echo "<a href=detail.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . ">詳細</a>\n";
        echo "｜<a href=edit.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . ">変更</a>\n";
        echo "｜<a href=delete.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . ">削除</a>\n";
        echo "</td>\n";
        echo "</tr>\n";
    }
    echo "</table>\n";
    $dbh = null;
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}
?>
</body>
</html>