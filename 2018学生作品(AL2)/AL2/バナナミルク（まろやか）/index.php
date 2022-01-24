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
        レシピを絞り込む<br>
        <form method="post" action="search.php">
            料理名:
            <input type="text" name="recipe_name">
            
            カテゴリ:
            <select name="category">
                <option value="">指定しない</option>
                <option value="1">和食</option>
                <option value="2">中華</option>
                <option value="3">洋食</option>
            </select>
            
            難易度:
            <select name="difficulty">
                <option value="">指定しない</option>
                <option value="1">簡単</option>
                <option value="2">普通</option>
                <option value="3">難しい</option>
            </select>
            
            予算:
            <select name="budget">
                <option value="">指定しない</option>
                <option value="1">500円以下</option>
                <option value="2">500~1000円</option>
                <option value="3">1000~2000円</option>
                <option value="4">2000~5000円</option>
                <option value="5">5000円以上</option>
            </select>
            
            <input type="submit" value="検索">
            <br>
        </form>
        <br><a href="form.html">レシピの新規登録</a>
<?php
require_once 'db_config.php';

$dif_array = array("未入力","簡単","普通","難しい");

try {
    $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM recipes_b";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>\n";
    echo "<tr>\n";
    echo "<th></th><th>料理名</th><th>予算</th><th>難易度</th>\n";
    echo "</tr>\n";
    foreach ($result as $row) {
        echo "<tr>\n";
        echo "<td><img src=\"" . $row['picture'] . "\" alt='image' width='180' height='120'></td>\n";
        echo "<td>" . $row['recipe_name'] . " </td>\n";
        echo "<td>" . $row['budget'] . " </td>\n";
        echo "<td>" . $dif_array[$row['difficulty']] . " </td>\n";

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