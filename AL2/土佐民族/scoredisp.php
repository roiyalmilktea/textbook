<?php

session_start();

$user = "root";
$pass = "root";

$count = 1;

$name = $_SESSION['name'];

try {
	$dbh = new PDO('mysql:host=localhost;dbname=logindb;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM usertable ORDER BY score DESC";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<table>\n";
    echo "<tr>\n";
    echo "<th>順位</th><th>ユーザー名</th><th>スコア</th>\n";
    echo "</tr>\n";
    foreach ($result as $row) {
        echo "<tr>\n";
        echo "<td>" . $count . "</td>\n";
        echo "<td>" . htmlspecialchars($row['name'],ENT_QUOTES,'UTF-8') . "</td>\n";
        echo "<td>" . htmlspecialchars($row['score'],ENT_QUOTES,'UTF-8') . "</td>\n";
        echo "</tr>\n";
        $count++;
    }
	echo "</table>\n";
	
	$count = 0;
	
    $dbh = null;
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <a href="login.php" ><input type="button" value="戻る"></a>
    </body>
</html>
