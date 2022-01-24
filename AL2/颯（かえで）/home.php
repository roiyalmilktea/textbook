<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="default.css">
    <title>ホーム</title>
</head>
    
<body>
    <header>
        <div>
            <a href="Home.php">HOME</a>
            <a href="index.html">投稿</a>
            <ul id="nav">
                <li><a href="home.php?category=1">音楽</a></li>
                <li><a href="home.php?category=2">メディア</a></li>
                <li><a href="home.php?category=3">映画</a></li>
                <li><a href="home.php?category=4">スポーツ</a></li>
                <li><a href="home.php?category=5">娯楽</a></li>
                <li><a href="home.php?category=6">漫画・アニメ・ゲーム</a></li>
                <li><a href="home.php?category=7">旅行・アミューズメントパーク・アウトドア</a></li>
                <li><a href="home.php?category=8">食</a></li>
                <li><a href="home.php?category=9">生活</a></li>
                <li><a href="home.php?category=10">教養</a></li>
                <li><a href="home.php?category=11">その他</a></li>
            </ul>
        </div>
    </header>
    <div class = "margin"></div>
<?php
    try 
    {
        $user = "root";
        $pass = "root";
        $dbh = new PDO('mysql:host=localhost;dbname=thread;charset=utf8', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $content_length = 50;
        $category_list = array
        (
            1    => "音楽",
            2    => "メディア",
            3    => "映画",
            4    => "スポーツ",
            5    => "娯楽",
            6    => "漫画・アニメ・ゲーム",
            7    => "旅行・アミューズメントパーク・アウトドア",
            8    => "食",
            9    => "生活",
            10    => "教養",
            11    => "その他",
        );
        
        if (empty($_GET['category']))
        {
            $sql = "SELECT * FROM thread";
            $stmt = $dbh->query($sql);
        }
        else
        {
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $category = (int) $_GET['category'];
            $sql = "SELECT * FROM thread WHERE category = ?";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(1, $category, PDO::PARAM_INT);
            $stmt->execute();
        }
        
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        //記事を表示
        foreach($result as $row)
        {
            echo "<div class=\"thread\">\n";
            echo "<a href=detail.php?thread_id=" . htmlspecialchars($row['thread_id'],ENT_QUOTES,'UTF-8') . ">";
            echo "<div>" . htmlspecialchars($row['title'],ENT_QUOTES,'UTF-8') . "</div>\n";
            echo mb_substr(htmlspecialchars($row['content'],ENT_QUOTES,'UTF-8'),0,$content_length) . "</a><br>" . "<a href=home.php?category=" . htmlspecialchars($row['category'],ENT_QUOTES,'UTF-8') . ">";
            echo $category_list[$row['category']];
            echo "</a>\n " . htmlspecialchars($row['date'],ENT_QUOTES,'UTF-8') . "</div>\n";
        }

        $dbh = null;
    }
    catch (Exception $e)
    {
        echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
        die();
    }
?>
</body>