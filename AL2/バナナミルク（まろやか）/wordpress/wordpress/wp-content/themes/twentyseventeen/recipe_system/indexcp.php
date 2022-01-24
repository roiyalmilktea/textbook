<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>
        レシピの一覧
    </title>
    </head>
    <body>
        <h1>レシピの一覧</h1><br>
        <a href="/wordpress/form_recipe">レシピの新規登録</a>
<?php
require_once '\MAMP\db_config.php';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM recipes";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>\n";
    echo "<tr>\n";
    echo "<th></th><th>料理名</th><th>予算</th><th>難易度</th>\n";
    echo "</tr>\n";
    foreach ($result as $row) {
        echo "<tr>\n";
        echo "<td><img src=\"" . $row['picture'] . "\" alt='image' width='120' height='80'></td>\n";
        echo "<td>" . $row['recipe_name'] . " </td>\n";
        echo "<td>" . $row['budget'] . " </td>\n";
        echo "<td>" . $row['difficulty'] . " </td>\n";

        echo "<td>\n";
        echo "<a href=/wordpress/detail_recipe?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">詳細</a>\n";
        echo "<a href=/wordpress/edit_recipe?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
        echo "<a href=/wordpress/delete_recipe?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";

        echo "</tr>\n";
    }
    echo "</table>\n";



    //print_r($result);

    $dbh = null;
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, UTF-8) . "<br>";
    die();
}
?>