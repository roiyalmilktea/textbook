<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>出力結果</title>
</head>
<body>
<?php
// print_r($_POST);
echo htmlspecialchars($_POST['day'],ENT_QUOTES,'UTF-8');
echo "<br>";
echo htmlspecialchars($_POST['plan_name'],ENT_QUOTES,'UTF-8');
echo "<br>";
if ($_POST['category'] === '1') echo "仕事";
if ($_POST['category'] === '2') echo "遊び";
if ($_POST['category'] === '3') echo "その他";
echo "<br>";
if ($_POST['importance'] === '1') {
    echo "低";
} elseif ($_POST['difficulty'] === '2') {
    echo "中";
} else {
    echo "高";
}
echo "<br>";
if (is_numeric($_POST['memo'])) {
    echo number_format($_POST['memo']);
}
echo "<br>";
echo nl2br(htmlspecialchars($_POST['memo'],ENT_QUOTES,'UTF-8'));
echo "<br>"
?>
</body>
</html>